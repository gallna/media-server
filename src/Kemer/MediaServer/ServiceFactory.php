<?php
namespace Kemer\UPnP\Server;

use Kemer\UPnP\Services;
use Kemer\UPnP\Server\MediaServer\ContentDirectory;
use Kemer\UPnP\Server\MediaServer\ConnectionManager;
use Kemer\UPnP\Server\MediaServer\AVTransport;

class ServiceFactory
{
    public function createService(Service $service)
    {
        return new \SoapServer(null,
            [
                'uri' => $service->getServiceId(),
                'location' => $service->getSCPDURL(),
                'soap_version' => SOAP_1_2,
                'trace' => true,
            ]
        );
    }
}
