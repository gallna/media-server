<?php
namespace Kemer\MediaServer;

interface ContentDirectoryInterface
{
    /**
     * This indicates that the properties of the object specified by the
     * ObjectID parameter will be returned in the result.
     */
    const BROWSE_METADATA = "BrowseMetadata";

    /**
     * indicates that first level objects under the object specified by
     * ObjectID parameter will be returned in the result, as well as
     * the metadata of all objects specified.
     */
    const BROWSE_DIRECT_CHILDREN = "BrowseDirectChildren";

    /**
     * This action returns the searching capabilities that are supported by the device.
     *
     * @return SearchCapabilitiesInterface
     */
    public function getSearchCapabilities();

    /**
     * Returns the CSV list of meta-data tags that can be used in sortCriteria
     *
     * @return SortCapabilitiesInterface
     */
    public function getSortCapabilities();

    /**
     * This action returns the current value of state variable SystemUpdateID.
     * It can be used by clients that want to ‘poll’ for any changes in the
     * Content Directory (as opposed to subscribing to events).
     *
     * @returns string This required variable changes whenever anything in the
     *                 Content Directory changes.
     */
    public function getSystemUpdateID();

    /**
     * This action allows the caller to incrementally browse the native hierarchy
     * of the Content Directory objects exposed by the Content Directory Service,
     * including information listing the classes of objects available in any particular
     * object container.
     *
     * @param  string $objectID uniquely identify individual objects within
     *                          the Content Directory Service.
     * @param  string $browseflag Browse option to be used for browsing the Content Directory.
     *                            Valid values are: "BrowseMetadata" or "BrowseDirectChildren"
     *                            See: BROWSE_METADATA and BROWSE_DIRECT_CHILDREN constants
     * @param  integer $startingIndex Index parameters specify an offset into
     *                                an arbitrary list of objects
     * @param  integer $requestedCount Count parameters specify an ordinal number
     *                                 of arbitrary objects.
     * @param  ContentDirectory\FilterInterface $filter
     * @param  ContentDirectory\SortCriteriaInterface $sortCriteria
     *
     * @return ContentDirectory\BrowseInterface
     */
    public function browse(
        $objectID,
        $browseflag,
        ContentDirectory\FilterInterface $filter,
        $startingIndex,
        $requestedCount,
        ContentDirectory\SortCriteriaInterface $sortCriteria
    );
}
