<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\RiskManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\RiskManagement\Models;

use Modules\Organization\Models\Department as OrgDepartment;

/**
 * Risk Management class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class Department
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    public int $id = 0;

    public ?OrgDepartment $department = null;

    public ?int $responsible = null;

    public ?int $deputy = null;
}
