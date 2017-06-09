<?php
/**
 * Copyright (C) Piwik PRO - All rights reserved.
 *
 * Using this code requires that you first get a license from Piwik PRO.
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 *
 * @link http://piwik.pro
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

    public static function getPrettified($value, $useOsFullName = true, $useBrowserFullName = true)
    {
        $parts = explode(";", $value);
        if (empty($parts)
            || count($parts) != self::DIMENSION_VALUE_PART_COUNT
        ) {
            return $value;
        }

        list($deviceType, $os, $osVersion, $browserName, $browserVersion) = $parts;

        $deviceType = \Piwik\Plugins\DevicesDetection\getDeviceTypeLabel($deviceType);

        if ($useBrowserFullName) {
            $browserLabel = \Piwik\Plugins\DevicesDetection\getBrowserNameWithVersion($browserName . ';' . $browserVersion);
        } else {
            $browserLabel = \Piwik\Plugins\DevicesDetection\getBrowserName($browserName);
        }

        if ($useOsFullName) {
            $osLabel = \Piwik\Plugins\DevicesDetection\getOsFullName($os . ';' . $osVersion);
        } else {
            $osLabel = \Piwik\Plugins\DevicesDetection\getOSFamilyFullName($os);
        }

        return $deviceType . " / " . $osLabel . " / " . $browserLabel;
    }
}
