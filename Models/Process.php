<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\RiskManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\RiskManagement\Models;

use Modules\Organization\Models\Unit;

/**
 * Risk Management class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Process
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    public string $title = '';

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    public string $description = '';

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    public string $descriptionRaw = '';

    private ?Department $department = null;

    private ?int $responsible = null;

    private ?int $deputy = null;

    private ?Unit $unit = null;

    /**
     * Get id.
     *
     * @return int Model id
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get unit.
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set unit.
     *
     * @param mixed $unit Unit
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setUnit($unit) : void
    {
        $this->unit = $unit;
    }

    /**
     * Get department.
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set department.
     *
     * @param mixed $department Department
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDepartment($department) : void
    {
        $this->department = $department;
    }

    /**
     * Get responsible.
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getResponsible()
    {
        return $this->responsible;
    }

    /**
     * Set responsible.
     *
     * @param mixed $responsible Responsible
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setResponsible($responsible) : void
    {
        $this->responsible = $responsible;
    }

    /**
     * Get deputy.
     *
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getDeputy()
    {
        return $this->deputy;
    }

    /**
     * Set deputy.
     *
     * @param mixed $deputy Deputy
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDeputy($deputy) : void
    {
        $this->deputy = $deputy;
    }
}
