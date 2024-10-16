<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\RiskManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\RiskManagement\Models;

use phpOMS\Stdlib\Base\Enum;

/**
 * Permission category enum.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
abstract class PermissionCategory extends Enum
{
    public const COCKPIT = 1;

    public const RISK = 2;

    public const CAUSE = 3;

    public const SOLUTION = 4;

    public const UNIT = 5;

    public const DEPARTMENT = 6;

    public const CATEGORY = 7;

    public const PROJECT = 8;

    public const PROCESS = 9;

    public const SETTINGS = 10;
}
