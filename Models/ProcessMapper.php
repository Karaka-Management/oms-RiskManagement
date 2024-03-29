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

use Modules\Organization\Models\DepartmentMapper;
use Modules\Organization\Models\UnitMapper;
use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Risk process mapper class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of Process
 * @extends DataMapperFactory<T>
 */
final class ProcessMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'riskmngmt_process_id'             => ['name' => 'riskmngmt_process_id',             'type' => 'int',    'internal' => 'id'],
        'riskmngmt_process_name'           => ['name' => 'riskmngmt_process_name',           'type' => 'string', 'internal' => 'title'],
        'riskmngmt_process_department'     => ['name' => 'riskmngmt_process_department',     'type' => 'int',    'internal' => 'department'],
        'riskmngmt_process_unit'           => ['name' => 'riskmngmt_process_unit',           'type' => 'int',    'internal' => 'unit'],
        'riskmngmt_process_responsible'    => ['name' => 'riskmngmt_process_responsible',    'type' => 'int',    'internal' => 'responsible'],
        'riskmngmt_process_deputy'         => ['name' => 'riskmngmt_process_deputy',         'type' => 'int',    'internal' => 'deputy'],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:class-string, external:string, column?:string, by?:string}>
     * @since 1.0.0
     */
    public const BELONGS_TO = [
        'department' => [
            'mapper'   => DepartmentMapper::class,
            'external' => 'riskmngmt_process_department',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'riskmngmt_process';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'riskmngmt_process_id';
}
