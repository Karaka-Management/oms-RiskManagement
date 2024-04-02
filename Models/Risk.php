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

use Modules\Admin\Models\Account;
use Modules\Organization\Models\Department;
use Modules\ProjectManagement\Models\Project;
use phpOMS\Stdlib\Base\FloatInt;

/**
 * Risk Management class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 */
class Risk
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    public int $id = 0;

    public int $status = RiskStatus::ACTIVE;

    /**
     * Name.
     *
     * @var string
     * @since 1.0.0
     */
    public string $name = '';

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

    public int $unit = 0;

    public ?Department $department = null;

    public ?Category $category = null;

    public ?Project $project = null;

    public ?Process $process = null;

    public ?Account $responsible = null;

    public ?Account $deputy = null;

    public array $histScore = [];

    public array $causes = [];

    public array $solutions = [];

    public array $riskObjects = [];

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
        $this->createdAt         = new \DateTimeImmutable('now');
        $this->grossCost         = new FloatInt();
        $this->grossExpectedCost = new FloatInt();
        $this->netCost           = new FloatInt();
        $this->netExpectedCost   = new FloatInt();
    }

    use \Modules\Media\Models\MediaListTrait;
}
