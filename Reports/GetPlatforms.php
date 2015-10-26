<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\PlatformsReport\Reports;

use Piwik\Menu\MenuReporting;
use Piwik\Piwik;
use Piwik\Plugin\Report;
use Piwik\Plugin\ViewDataTable;
use Piwik\Plugins\PlatformsReport\Columns\Platform;

class GetPlatforms extends Report
{
    protected function init()
    {
        parent::init();

        $this->category = 'General_Visitors';
        $this->dimension = new Platform();
        $this->name = Piwik::translate('PlatformsReport_Platforms');
        $this->documentation = Piwik::translate('PlatformsReport_GetPlatformsDocumentation');
        $this->widgetTitle = 'PlatformsReport_Platforms';
        $this->order = 30;
        $this->menuTitle   = 'PlatformsReport_Platforms';
    }

    public function configureView(ViewDataTable $view)
    {
        $view->config->addTranslation('label', $this->dimension->getName());
    }

    public function getRelatedReports()
    {
        return array(
            new GetPlatformsWithVersions(),
        );
    }
}
