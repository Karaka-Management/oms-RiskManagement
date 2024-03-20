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

use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Risk category mapper class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of Category
 * @extends DataMapperFactory<T>
 */
final class CategoryMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'riskmngmt_category_id'             => ['name' => 'riskmngmt_category_id',             'type' => 'int',    'internal' => 'id'],
        'riskmngmt_category_name'           => ['name' => 'riskmngmt_category_name',           'type' => 'string', 'internal' => 'title'],
        'riskmngmt_category_description'    => ['name' => 'riskmngmt_category_description',    'type' => 'string', 'internal' => 'description'],
        'riskmngmt_category_descriptionraw' => ['name' => 'riskmngmt_category_descriptionraw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'riskmngmt_category_parent'         => ['name' => 'riskmngmt_category_parent',         'type' => 'int',    'internal' => 'parent'],
        'riskmngmt_category_responsible'    => ['name' => 'riskmngmt_category_responsible',    'type' => 'int',    'internal' => 'responsible'],
        'riskmngmt_category_deputy'         => ['name' => 'riskmngmt_category_deputy',         'type' => 'int',    'internal' => 'deputy'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'riskmngmt_category';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'riskmngmt_category_id';
}
