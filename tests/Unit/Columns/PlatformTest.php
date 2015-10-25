<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\PlatformsReport\tests\Unit\Columns;
use Piwik\Plugins\PlatformsReport\Columns\Platform;

/**
 * @group PlatformsReport
 * @group PlatformsReport_Unit
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
