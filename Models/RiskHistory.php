<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\RiskManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\RiskManagement\Models;

use Modules\Organization\Models\Department;
use Modules\ProjectManagement\Models\Project;
use phpOMS\Stdlib\Base\FloatInt;

/**
 * Risk Management class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 */
class RiskHistory
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    public int $id = 0;

    public int $unit = 0;

    public ?Department $department = null;

    public ?Category $category = null;

    public ?Project $project = null;

    public ?Process $process = null;

    public Risk $risk;

    public \DateTimeImmutable $createdAt;

    public float $grossLikelihoodR = 0.0;

    public int $grossLikelihoodLevel = 0;

    public int $grossCostLevel = 0;

    public FloatInt $grossCost;

    public FloatInt $grossExpectedCost;

    public float $netLikelihoodR = 0.0;

    public int $netLikelihoodLevel = 0;

    public int $netCostLevel = 0;

    public FloatInt $netCost;

    public FloatInt $netExpectedCost;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->risk              = new NullRisk();
        $this->createdAt         = new \DateTimeImmutable('now');
        $this->grossCost         = new FloatInt();
        $this->grossExpectedCost = new FloatInt();
        $this->netCost           = new FloatInt();
        $this->netExpectedCost   = new FloatInt();
    }

    use \Modules\Media\Models\MediaListTrait;
}
