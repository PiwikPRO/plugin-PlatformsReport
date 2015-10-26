<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\PlatformsReport\Reports;

use Piwik\Piwik;
use Piwik\Plugin\Report;
use Piwik\Plugin\ViewDataTable;
use Piwik\Plugins\PlatformsReport\Columns\Platform;

class GetPlatformsWithVersions extends Report
{
    protected function init()
    {
        parent::init();

        $this->category = 'CoreHome_Visitors';
        $this->dimension = new Platform();
        $this->name = Piwik::translate('PlatformsReport_PlatformsWithVersions');
        $this->documentation = Piwik::translate('PlatformsReport_GetPlatformsWithVersionsDocumentation');
        $this->widgetTitle = 'PlatformsReport_PlatformsWithVersions';
        $this->order = 30;
    }

    public function configureView(ViewDataTable $view)
    {
        $view->config->addTranslation('label', $this->dimension->getName());
    }

    public function getRelatedReports()
    {
        return array(
            new GetPlatforms(),
        );
    }
}