<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   Modules\RiskManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\RiskManagement\Models;

/**
 * Risk Management class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Category
{
    /**
     * ID.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Title.
     *
     * @var string
     * @since 1.0.0
     */
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

    /**
     * Parent category.
     *
     * @var null|int|self
     * @since 1.0.0
     */
    public $parent = null;

    /**
     * Responsible person
     *
     * @var null|int
     * @since 1.0.0
     */
    public ?int $responsible = null;

    /**
     * Responsible person
     *
     * @var null|int
     * @since 1.0.0
     */
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
