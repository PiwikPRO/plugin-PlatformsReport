<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\PlatformsReport\Columns;

use Piwik\Columns\Dimension;
use Piwik\Piwik;

require_once PIWIK_INCLUDE_PATH . '/plugins/DevicesDetection/functions.php';

class Platform extends Dimension
{
    const DIMENSION_VALUE_PART_COUNT = 5;

    public function getName()
    {
        return Piwik::translate('PlatformsReport_Platform');
    }

    public static function getPrettified($value)
    {
        $parts = explode(";", $value);
        if (empty($parts)
            || count($parts) != self::DIMENSION_VALUE_PART_COUNT
        ) {
            return $value;
        }

        list($deviceType, $os, $osVersion, $browserName, $browserVersion) = $parts;

        $deviceType = \Piwik\Plugins\DevicesDetection\getDeviceTypeLabel($deviceType);
        $osFullName = \Piwik\Plugins\DevicesDetection\getOsFullName($os . ';' . $osVersion);
        $browserWithVersion = \Piwik\Plugins\DevicesDetection\getBrowserNameWithVersion($browserName . ';' . $browserVersion);

        return $deviceType . " / " . $osFullName . " / " . $browserWithVersion;
    }
}
