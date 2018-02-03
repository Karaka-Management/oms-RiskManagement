<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types = 1);

namespace Modules\RiskManagement\Models;

/**
 * Risk Management class.
 *
 * @package    Modules
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Solution
{
    private $id = 0;

    private $title = '';

    private $description = '';

    private $descriptionRaw = '';

    private $probability = 0.0;

    private $cause = null;

    private $risk = null;

    public function __construct()
    {
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function setRisk($risk) /* : void */
    {
        $this->risk = $risk;
    }

    public function getRisk()
    {
        return $this->risk;
    }

    public function setCause($cause) /* : void */
    {
        $this->cause = $cause;
    }

    public function getCause()
    {
        return $this->cause;
    }

    public function getProbability() : float
    {
        return $this->probability;
    }

    public function setProbability(float $probability) /* : void */
    {
        $this->probability = $probability;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function getDescriptionRaw() : string
    {
        return $this->descriptionRaw;
    }

    public function setDescriptionRaw(string $description) /* : void */
    {
        $this->descriptionRaw = $description;
    }
}