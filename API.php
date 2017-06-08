<?php
/**
 * Copyright (C) Piwik PRO - All rights reserved.
 *
 * Using this code requires that you first get a license from Piwik PRO.
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 *
 * @link http://piwik.pro
 */

namespace Piwik\Plugins\PlatformsReport;

use Piwik\Archive;
use Piwik\Piwik;

class API extends \Piwik\Plugin\API
{
    protected function getDataTable($name, $idSite, $period, $date, $segment)
    {
        Piwik::checkUserHasViewAccess($idSite);

        $archive = Archive::build($idSite, $period, $date, $segment);
        $dataTable = $archive->getDataTable($name);
        $dataTable->queueFilter('ReplaceColumnNames');
        $dataTable->queueFilter('ReplaceSummaryRowLabel');

        return $dataTable;
    }

    public function getPlatforms($idSite, $period, $date, $segment = false)
    {
        $dataTable = $this->getDataTable(Archiver::PLATFORMS_RECORD_NAME, $idSite, $period, $date, $segment);

        $getPlatformPrettyString = array('Piwik\Plugins\PlatformsReport\Columns\Platform', 'getPrettified');
        $dataTable->filter('GroupBy', array('label', $getPlatformPrettyString,
            array($useFullName = false, $useBrowserFullName = false)));

        return $dataTable;
    }

    public function getPlatformsWithVersions($idSite, $period, $date, $segment = false)
    {
        $dataTable = $this->getDataTable(Archiver::PLATFORMS_RECORD_NAME, $idSite, $period, $date, $segment);

        $getPlatformPrettyString = array('Piwik\Plugins\PlatformsReport\Columns\Platform', 'getPrettified');
        $dataTable->queueFilter('ColumnCallbackReplace', array('label', $getPlatformPrettyString));

        return $dataTable;
    }
}