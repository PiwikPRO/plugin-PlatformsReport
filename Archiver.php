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

use Piwik\Common;
use Piwik\Metrics;

class Archiver extends \Piwik\Plugin\Archiver
{
    const PLATFORMS_RECORD_NAME = 'PlatformsReport_Platforms';

    public function aggregateDayReport()
    {
        $this->aggregateVisitsByPlatforms();
    }

    public function aggregateMultipleReports()
    {
        $dataTableRecords = array(self::PLATFORMS_RECORD_NAME);

        $columnsAggregationOperation = null;
        $this->getProcessor()->aggregateDataTableRecords(
            $dataTableRecords,
            $this->maximumRows,
            $maximumRowsInSubDataTable = null,
            $columnToSortByBeforeTruncation = null,
            $columnsAggregationOperation,
            $columnsToRenameAfterAggregation = null,
            $countRowsRecursive = array());
    }

    private function aggregateVisitsByPlatforms()
    {
        $platformDimensionSql = 'CONCAT(log_visit.config_device_type, ";", log_visit.config_os, ";", '
            . 'log_visit.config_os_version, ";", log_visit.config_browser_name, ";", '
            . 'log_visit.config_browser_version)';

        $dataArray = $this->getLogAggregator()->getMetricsFromVisitByDimension($platformDimensionSql);
        $table = $dataArray->asDataTable();

        unset($dataArray);

        $report = $table->getSerialized($this->maximumRows, null, Metrics::INDEX_NB_VISITS);
        $this->getProcessor()->insertBlobRecord(self::PLATFORMS_RECORD_NAME, $report);

        Common::destroy($table);
        unset($table);
    }
}
