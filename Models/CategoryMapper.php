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
        'riskmngmt_category_parent'         => ['name' => 'riskmngmt_category_parent',         'type' => 'int',    'internal' => 'parent'],
        'riskmngmt_category_responsible'    => ['name' => 'riskmngmt_category_responsible',    'type' => 'int',    'internal' => 'responsible'],
        'riskmngmt_category_deputy'         => ['name' => 'riskmngmt_category_deputy',         'type' => 'int',    'internal' => 'deputy'],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:class-string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    public const HAS_MANY = [
        'title' => [
            'mapper'   => CategoryL11nMapper::class,
            'table'    => 'riskmngmt_category_l11n',
            'self'     => 'riskmngmt_category_l11n_category',
            'column'   => 'content',
            'external' => null,
        ],
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
