<?php
namespace Kemer\MediaServer;
use SoapVar;
use SoapParam;
use SimpleXmlElement;

use Kemer\MediaServer\ContentDirectory\Response;
use Kemer\MediaLibrary\LibraryInterface;
use Kemer\MediaLibrary\Item\ProtocolInfo;
use Kemer\MediaLibrary\Item\Res;

class ContentDirectory
{
    /**
     * Media library
     *
     * @var LibraryInterface
     */
    protected $library;

    /**
     * ContentDirectory server constructor
     *
     * @param LibraryInterface $library
     */
    public function __construct(LibraryInterface $library)
    {
        $this->library = $library;
    }

    public function getLibrary()
    {
        return $this->library;
    }

    /**
     * {@inheritDoc}
     */
    public function GetSearchCapabilities()
    {

    }

    /**
     * {@inheritDoc}
     */
    public function GetSortCapabilities()
    {
        return '';
    }

    /**
     * {@inheritDoc}
     */
    public function GetSystemUpdateID()
    {

    }

    /**
     * {@inheritDoc}
     */
    public function browse($objectID, $flag, $filter, $index, $count, $sortCriteria)
    {
        $result = $this->library->get($objectID);
        return new Response\BrowseResponse($result, count($result), count($result), 1);
    }

    public function search($objectID, $searchCriteria, $filter, $index, $count, $sortCriteria)
    {
        list($key, $value) = explode("=", $searchCriteria, 2);
        $result = $this->library->search($objectID, $key, $value);
        return new Response\BrowseResponse($result, count($result), count($result), 1);
    }

    public function createObject($containerID, array $elements)
    {
        $container = $this->library->get($containerID);
        foreach ($elements as $element) {
            $container->add($element);
            $this->library->add($element);
        }
    }

    public function DestroyObject()
    {

    }

    public function updateObject($objectID, array $current, array $new)
    {
        $object = $this->library->get("$objectID");
        foreach ($current as $key => $parameter) {
            if ($parameter == "res") {
                $updated = (object)$new[$key];
                $protocolInfo = (object)$updated->protocolInfo;
                $protocolInfo = (new ProtocolInfo())
                    ->setProtocol($protocolInfo->protocol)
                    ->setNetwork($protocolInfo->network)
                    ->setContentFormat($protocolInfo->contentFormat)
                    ->setAdditionalInfo($protocolInfo->additionalInfo);

                $res = (new Res($updated->res))
                    ->setProtocolInfo($protocolInfo);
                $object->addRes($res);
            }
        }
        return $object;
    }

    public function ImportResource()
    {

    }

    public function ExportResource()
    {

    }

    public function StopTransferResource()
    {

    }

    public function GetTransferProgress()
    {

    }

    public function DeleteResource()
    {

    }

    public function CreateReference()
    {

    }

}
