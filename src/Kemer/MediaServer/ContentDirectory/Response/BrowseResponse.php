<?php
namespace Kemer\MediaServer\ContentDirectory\Response;

class BrowseResponse
{
    public $result;
    public $numberReturned;
    public $totalMatches;
    public $updateID;

    /**
     * ContentDirectory server constructor
     *
     * @param LibraryInterface $library
     */
    public function __construct($result, $numberReturned, $totalMatches, $updateID)
    {
        $this->result = $result;
        $this->numberReturned = $numberReturned;
        $this->totalMatches = $totalMatches;
        $this->updateID = $updateID;
    }

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * {@inheritDoc}
     */
    public function getNumberReturned()
    {
        return $this->numberReturned;
    }

    /**
     * {@inheritDoc}
     */
    public function getTotalMatches()
    {
        return $this->totalMatches;
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdateID()
    {
        return $this->updateID;
    }
}
