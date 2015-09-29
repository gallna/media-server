<?php
namespace Kemer\MediaServer;

use Kemer\UPnP\Eventing;
use Kemer\UPnP\Description\Service;
use Kemer\UPnP\Description\Device\ServiceList\Service as ServiceDescription;
use Kemer\UPnP\Server\MediaServer\ContentDirectory;
use Kemer\UPnP\Server\MediaServer\ConnectionManager;
use Kemer\UPnP\Server\MediaServer\AVTransport;
use Zend\Soap\Server as SoapServer;

class MediaServer
{
    protected $contentDirectory;
    protected $connectionManager;
    protected $avTransport;

    public function getContentDirectory()
    {
        return $this->contentDirectory;
    }

    public function setContentDirectory(ContentDirectory $contentDirectory)
    {
        $this->contentDirectory = $contentDirectory;
        return $this;
    }

    public function setConnectionManager(ConnectionManager $connectionManager, \SoapServer $server = null)
    {
        $this->connectionManager = $connectionManager;
        return $this;
    }

    public function setAvTransport(AVTransport $avTransport, \SoapServer $server = null)
    {
        $this->avTransport = $avTransport;
        return $this;
    }
}
