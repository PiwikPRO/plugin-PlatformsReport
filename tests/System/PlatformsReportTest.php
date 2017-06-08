<?php
/**
 * Copyright (C) Piwik PRO - All rights reserved.
 *
 * Using this code requires that you first get a license from Piwik PRO.
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 *
 * @link http://piwik.pro
 */

namespace Piwik\Plugins\PlatformsReport\tests\System;

use Piwik\Tests\Fixtures\ManyVisitsWithMockLocationProvider;
use Piwik\Tests\Framework\TestCase\SystemTestCase;

/**
 * @group Plugins
 * @group PlatformsReport
 * @group PlatformsReport_System
 * @group PlatformsReport_System_PlatformsReportTest
 */
class PlatformsReportTest extends SystemTestCase
{
    /**
     * @var ManyVisitsWithMockLocationProvider
     */
    public static $fixture;

    public function getApiForTesting()
    {
        $idSite = self::$fixture->idSite;
        $dateTime = self::$fixture->dateTime;

        return array(
            array('PlatformsReport', array('idSite' => $idSite,
                                           'date' => $dateTime,
                                           'periods' => array('day'))),

            // API metadata tests
            array('API.getProcessedReport', array('idSite' => $idSite, 'date' => $dateTime,
                'apiModule'              => 'PlatformsReport',
                'apiAction'              => 'getPlatforms',
                'testSuffix'             => '_getPlatforms')),

            array('API.getProcessedReport', array('idSite' => $idSite, 'date' => $dateTime,
                'apiModule'              => 'PlatformsReport',
                'apiAction'              => 'getPlatformsWithVersions',
                'testSuffix'             => '_getPlatformsWithVersions')),
        );
    }

    /**
     * @dataProvider getApiForTesting
     */
    public function testApi($api, $params)
    {
        $this->runApiTests($api, $params);
    }

    public static function getPathToTestDirectory()
    {
        return __DIR__;
    }
}

PlatformsReportTest::$fixture = new ManyVisitsWithMockLocationProvider();
