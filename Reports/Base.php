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

use Piwik\Plugin\Report;
use Piwik\Plugin\ViewDataTable;
use Piwik\Plugins\PlatformsReport\Columns\Platform;

abstract class Base extends Report
{
    protected function init()
    {
        parent::init();

        $this->categoryId = 'General_Visitors';
        $this->subcategoryId = 'PlatformsReport_Platforms';
        $this->dimension = new Platform();
    }

    public function configureView(ViewDataTable $view)
    {
        $view->config->addTranslation('label', $this->dimension->getName());
    }
}
