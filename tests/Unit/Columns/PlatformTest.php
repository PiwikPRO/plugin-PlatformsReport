<?php
/**
 * Copyright (C) Piwik PRO - All rights reserved.
 *
 * Using this code requires that you first get a license from Piwik PRO.
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 *
 * @link http://piwik.pro
 */

namespace Piwik\Plugins\PlatformsReport\tests\Unit\Columns;
use Piwik\Plugins\PlatformsReport\Columns\Platform;

/**
 * @group Plugins
 * @group PlatformsReport
 * @group PlatformsReport_Unit
 * @group PlatformsReport_Unit_PlatformTest
 */
class PlatformTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getPrettifiedTestData
     */
    public function test_getPrettified_SkipsLabelsWithWrongNumberOfParts($label)
    {
        $prettified = Platform::getPrettified($label);
        $this->assertEquals($prettified, $label);
    }

    public function getPrettifiedTestData()
    {
        return array(
            array(false),
            array(null),
            array(''),
            array('no semicolons in sight'),
            array('there; we; go; bob'),
            array('not; now; duval; then; when; ?!'),
        );
    }
}
