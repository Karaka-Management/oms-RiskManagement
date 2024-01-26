<?php
/**
 * Jingga
 *
 * PHP Version 8.1
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
 * Risk solution mapper class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of Solution
 * @extends DataMapperFactory<T>
 */
final class SolutionMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'riskmngmt_solution_id'             => ['name' => 'riskmngmt_solution_id',             'type' => 'int',    'internal' => 'id'],
        'riskmngmt_solution_name'           => ['name' => 'riskmngmt_solution_name',           'type' => 'string', 'internal' => 'title'],
        'riskmngmt_solution_description'    => ['name' => 'riskmngmt_solution_description',    'type' => 'string', 'internal' => 'description'],
        'riskmngmt_solution_descriptionraw' => ['name' => 'riskmngmt_solution_descriptionraw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'riskmngmt_solution_probability'    => ['name' => 'riskmngmt_solution_probability',    'type' => 'int',    'internal' => 'probability'],
        'riskmngmt_solution_cause'          => ['name' => 'riskmngmt_solution_cause',          'type' => 'int',    'internal' => 'cause'],
        'riskmngmt_solution_risk'           => ['name' => 'riskmngmt_solution_risk',           'type' => 'int',    'internal' => 'risk'],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:class-string, external:string, column?:string, by?:string}>
     * @since 1.0.0
     */
    public const BELONGS_TO = [
        'risk' => [
            'mapper'   => RiskMapper::class,
            'external' => 'riskmngmt_solution_risk',
        ],
        'cause' => [
            'mapper'   => CauseMapper::class,
            'external' => 'riskmngmt_solution_cause',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'riskmngmt_solution';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'riskmngmt_solution_id';
}
