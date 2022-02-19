<?php
/**
 * Karaka
 *
 * PHP Version 8.0
 *
 * @package   Modules\RiskManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://karaka.app
 */
declare(strict_types=1);

namespace Modules\RiskManagement\Models;

use Modules\ProjectManagement\Models\Project as PMProject;

/**
 * Risk Management class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 1.0
 * @link    https://karaka.app
 * @since   1.0.0
 */
class Project
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    public ?PMProject $project = null;

    public ?int $responsible = null;

    public ?int $deputy = null;

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
}
