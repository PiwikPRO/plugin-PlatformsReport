<?php
/**
 * Copyright (C) Piwik PRO - All rights reserved.
 *
 * Using this code requires that you first get a license from Piwik PRO.
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 *
 * @link http://piwik.pro
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

        $this->categoryId = 'General_Visitors';
        $this->name = Piwik::translate('PlatformsReport_PlatformsWithVersions');
        $this->widgetTitle = 'PlatformsReport_PlatformsWithVersions';
        $this->dimension = new Platform();
        $this->documentation = Piwik::translate('PlatformsReport_GetPlatformsWithVersionsDocumentation');
        $this->order = 52;
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