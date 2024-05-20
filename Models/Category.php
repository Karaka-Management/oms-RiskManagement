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

use phpOMS\Localization\BaseStringL11n;
use phpOMS\Localization\ISO639x1Enum;

/**
 * Risk Management class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 2.2
 * @link    https://jingga.app
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
    public int $id = 0;

    /**
     * Title.
     *
     * @var string|BaseStringL11n
     * @since 1.0.0
     */
    public string | BaseStringL11n $title = '';

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
     * @return string
     *
     * @since 1.0.0
     */
    public function getL11n() : string
    {
        return $this->title instanceof BaseStringL11n ? $this->title->content : $this->title;
    }

    /**
     * Set title
     *
     * @param string|BaseStringL11n $title Tag article title
     * @param string                $lang  Language
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setL11n(string | BaseStringL11n $title, string $lang = ISO639x1Enum::_EN) : void
    {
        if ($title instanceof BaseStringL11n) {
            $this->title = $title;
        } elseif (isset($this->title) && $this->title instanceof BaseStringL11n) {
            $this->title->content = $title;
        } else {
            $this->title           = new BaseStringL11n();
            $this->title->content  = $title;
            $this->title->language = $lang;
        }
    }
}
