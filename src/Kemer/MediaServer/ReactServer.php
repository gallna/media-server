<?php
namespace Kemer\UPnP\Server;
error_reporting(-1);
ini_set("display_errors", true);
ini_set("soap.wsdl_cache_enabled", "0");
use_soap_error_handler(true);
use Kemer\UPnP\Description\Device\DeviceDescription;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Http\Exception as ZendException;
use React;

class ReactServer
{
    protected $mediaServer;
    protected $sender;
    protected $socket;

    protected $services = [];
    protected $eventings = [];
    protected $routing = [];

    private $descriptionXmlUrl;

    public function __construct(MediaServer $mediaServer)
    {
        $this->mediaServer = $mediaServer;
    }

    public function getMediaServer()
    {
        return $this->mediaServer;
    }

    public function createRouting()
    {
        $routing = [];
        $routing[$this->getDescription()->getLocation()->getPath()] = [$this, "handleDeviceDescription"];

        foreach ($this->getDescription()->getIconList()->all() as $icon) {
            $routing[$icon->getUrl()] = [$this, "handleDeviceIcon"];
        }

        foreach ($this->getDescription()->getServiceList() as $service) {
            $routing[$service->getSCPDURL()] = [$this, "handleServiceDescription"];
            $routing[$service->getControlURL()] = [$this, "handleControlRequest"];
            $routing[$service->getEventSubURL()] = [$this, "handleEventRequest"];
        }
        return $routing;
    }

    public function run()
    {
        $this->routing = $this->createRouting();
        $loop = React\EventLoop\Factory::create();
        $socket = new React\Socket\Server($loop);
        $socket->on('connection', [$this, "handleConnection"]);
        $socket->on('error', function () {
            var_dump(func_get_args());
        });
        $socket->on('end', function ($data) {
            var_dump($data, "blue");
        });
        $socket->listen(
            $this->getDescription()->getLocation()->getPort(),
            $this->getDescription()->getLocation()->getHost()
        );
        $loop->run();
    }

    public function handleConnection($conn)
    {
        $buffer = null;
        $conn->on('data', function ($data) use (&$buffer, $conn) {
            // e($data, "blue");
            // e("--------------", "green");
            $buffer .= $data;
            if (preg_match('/Content-Length:\s?(?P<length>\d+)/', $buffer, $matches)) {
                // Check it isn't chunked request
                if (strpos($buffer, "\r\n\r\n") != (strlen($buffer) - 4)) {
                    $conn->write($this->handleData($buffer));
                    $conn->end();
                }
            } else {
                $conn->write($this->handleData($buffer));
                $conn->end();
                return;
            }
        });
    }

    public function handleData($rawRequest)
    {
        $request = Request::fromString($rawRequest);
        $uri = $request->getUriString();
        e($uri, 'green');
        if (isset($this->routing[$uri])) {
            $response = call_user_func($this->routing[$uri], $request, $rawRequest);
            return $response->toString();
        }
        if ((strrpos($uri, "media")) !== false) {
            // $id = substr($uri, strrpos($uri, "/")+1);
            // e($uri, 'blue');
            // $library = $this->getContentDirectory()->getLibrary();
            // $item = $library->get($id);
            // $res = $item->getRes()[0];
            // $file = $res->getRes();
        }
        e($uri, 'red');
        return;
    }

    public function handleDeviceDescription(Request $request)
    {
        $xml = $this->getDescription()->toXml();
        $response = new Response();
        $response->setStatusCode(Response::STATUS_CODE_200);
        $response->getHeaders()->addHeaders([
            'Content-Type' => 'text/xml; charset=utf-8',
        ]);
        $response->setContent($xml);
        return $response;
    }

    public function handleDeviceIcon(Request $request)
    {
        $uri = $request->getUri();
        $path = $uri->getPath();
        $icon = file_get_contents(__DIR__."/".$path);
        $response = new Response();
        $response->setStatusCode(Response::STATUS_CODE_200);
        $response->getHeaders()->addHeaders([
            'Content-Type' => 'image/png',
        ]);
        $response->setContent($icon);
        return $response;
    }

    public function handleServiceDescription(Request $request)
    {
        $uri = $request->getUriString();
        $service = $this->getDescription()->getServiceList()->filter(
            function ($service) use ($uri) {
                return $service->getSCPDURL() == $uri;
        });
        $xml = reset($service)->toXml();
        $response = new Response();
        $response->setStatusCode(Response::STATUS_CODE_200);
        $response->getHeaders()->addHeaders([
            'Content-Type' => 'text/xml; charset=utf-8',
        ]);
        $response->setContent($xml);
        return $response;
    }

    public function handleControlRequest(Request $request, $rawRequest)
    {
        $path = $request->getUri()->getPath();
        list($service) = (explode("/", $path, 1));
        switch($service) {
            case "contentDirectory":
                $service = $this->mediaServer->getContentDirectory();
                break;
            case "connectionManager":
                $service = $this->mediaServer->getConnectionManager();
                break;
            case "avTransport":
                $service = $this->mediaServer->getAvTransport();
                break;
            default:
                throw new \Exception("Controller not found");
        }
        $handler->handle($request);
        $content = json_decode($request->getContent());
        $response = call_user_func_array([$service, $action], $content);
        $formater->format($response, )

        $response = $response->handle($request);
        $response = new Response();
        $response->setStatusCode(Response::STATUS_CODE_200);
        $response->getHeaders()->addHeaders([
            'Content-Type' => 'text/xml; charset=utf-8',
            'Server' => "Linux/3.x, UPnP/1.0, Kemer/0.1",
            'Content-Length' => strlen($xml),
        ]);
        $response->setContent($xml);



        $uri = $request->getUriString();
        $service = $this->getDescription()->getServiceList()->filter(
            function ($service) use ($uri) {
                return $service->getControlURL() == $uri;
        });
        $server = $this->getService(reset($service)->getServiceType());
        // echo $request->getContent();
        e($request->getContent(), "green");
        file_put_contents(__DIR__."/log.txt", $request->getContent(), FILE_APPEND);
        ob_start();
        $server->handle($request->getContent());
        $xml = ob_get_clean();
        file_put_contents(__DIR__."/log.txt", $xml, FILE_APPEND);
        $dom = new \DOMDocument("1.0");
        $dom->formatOutput = true;
        $dom->loadXML($xml);
        e($dom->saveXML(), "light_blue");
        // echo $xml;
        $response = new Response();
        $response->setStatusCode(Response::STATUS_CODE_200);
        $response->getHeaders()->addHeaders([
            'Content-Type' => 'text/xml; charset=utf-8',
            'Server' => "Linux/3.x, UPnP/1.0, Kemer/0.1",
            'Content-Length' => strlen($xml),
        ]);
        $response->setContent($xml);
        e((string)$response, "light_blue");
        return $response;
    }

    public function handleEventRequest(Request $request)
    {
        $uri = $request->getUriString();
        $service = $this->getDescription()->getServiceList()->filter(
            function ($service) use ($uri) {
                return $service->getEventSubURL() == $uri;
        });
        $eventing = $this->getEventing(reset($service)->getServiceType());
        return $response = $eventing->handleRequest($request);
        var_dump($request, $eventing);
    }
}


