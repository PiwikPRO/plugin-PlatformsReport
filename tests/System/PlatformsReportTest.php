<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\PlatformsReport\tests\System;

use Piwik\Tests\Fixtures\ManyVisitsWithMockLocationProvider;
use Piwik\Tests\Framework\TestCase\SystemTestCase;

/**
 * @group PlatformsReport
 * @group PlatformsReport_System
 */
class PlatformsReportTest extends SystemTestCase
{
    /**
     * @var ManyVisitsWithMockLocationProvider
     */
    public static $fixture;

    public function getApiForTesting()
    {
        return array(
            array('PlatformsReport', array('idSite' => self::$fixture->idSite,
                                           'date' => self::$fixture->dateTime,
                                           'periods' => 'day')),
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
