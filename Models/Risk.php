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

use Modules\Organization\Models\Department;
use Modules\Organization\Models\Unit;

/**
 * Risk Management class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 1.0
 * @link    https://karaka.app
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
    protected int $id = 0;

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

    public ?Unit $unit = null;

    public ?Department $department = null;

    public ?Category $category = null;

    public ?Project $project = null;

    public ?Process $process = null;

    public ?int $responsible = null;

    public ?int $deputy = null;

    private array $histScore = [];

    private array $causes = [];

    private array $solutions = [];

    private array $riskObjects = [];

    private array $media = [];

    public \DateTimeImmutable $createdAt;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable('now');
    }

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
     * Add cause.
     *
     * @param mixed $cause Cause
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addCause($cause) : void
    {
        $this->causes[] = $cause;
    }

    /**
     * Get causes
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getCauses() : array
    {
        return $this->causes;
    }

    /**
     * Add solution.
     *
     * @param mixed $solution Solution
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addSolution($solution) : void
    {
        $this->solutions[] = $solution;
    }

    /**
     * Get solutions
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getSolutions() : array
    {
        return $this->solutions;
    }

    /**
     * Get media
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getMedia() : array
    {
        return $this->media;
    }

    /**
     * Add media.
     *
     * @param mixed $media Media
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addMedia($media) : void
    {
        $this->media[] = $media;
    }

    /**
     * Add risk object.
     *
     * @param mixed $object Risk object
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addRiskObject($object) : void
    {
        $this->riskObjects[] = $object;
    }

    /**
     * Get risk objects
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getRiskObjects() : array
    {
        return $this->riskObjects;
    }

    /**
     * Add history.
     *
     * @param mixed $history History
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addHistory($history) : void
    {
        $this->histScore[] = $history;
    }

    /**
     * Get history
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getHistory() : array
    {
        return $this->histScore;
    }
}
