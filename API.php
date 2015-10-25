<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
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
        $dataTable->queueFilter('ColumnCallbackReplace', array('label', $getPlatformPrettyString));

        return $dataTable;
    }
}