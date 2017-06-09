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
use Piwik\Plugin\ViewDataTable;

class GetPlatformsWithVersions extends Base
{
    protected function init()
    {
        parent::init();

        $this->name = Piwik::translate('PlatformsReport_PlatformsWithVersions');
        $this->documentation = Piwik::translate('PlatformsReport_GetPlatformsWithVersionsDocumentation');
        $this->order = 52;
    }

    public function getRelatedReports()
    {
        return array(
            new GetPlatforms(),
        );
    }
}
