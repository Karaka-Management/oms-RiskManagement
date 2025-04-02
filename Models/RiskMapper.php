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

use Modules\Admin\Models\AccountMapper;
use Modules\Media\Models\MediaMapper;
use Modules\Organization\Models\DepartmentMapper;
use Modules\ProjectManagement\Models\ProjectMapper;
use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Risk mapper class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of Risk
 * @extends DataMapperFactory<T>
 */
final class RiskMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'riskmngmt_risk_id'                   => ['name' => 'riskmngmt_risk_id',             'type' => 'int',      'internal' => 'id'],
        'riskmngmt_risk_status'               => ['name' => 'riskmngmt_risk_status',           'type' => 'int',   'internal' => 'status'],
        'riskmngmt_risk_name'                 => ['name' => 'riskmngmt_risk_name',           'type' => 'string',   'internal' => 'name'],
        'riskmngmt_risk_description'          => ['name' => 'riskmngmt_risk_description',    'type' => 'string',   'internal' => 'description'],
        'riskmngmt_risk_descriptionraw'       => ['name' => 'riskmngmt_risk_descriptionraw', 'type' => 'string',   'internal' => 'descriptionRaw'],
        'riskmngmt_risk_grosslikelihoodr'     => ['name' => 'riskmngmt_risk_grosslikelihoodr',           'type' => 'float',      'internal' => 'grossLikelihoodR'],
        'riskmngmt_risk_grosslikelihoodlevel' => ['name' => 'riskmngmt_risk_grosslikelihoodlevel',           'type' => 'int',      'internal' => 'grossLikelihoodLevel'],
        'riskmngmt_risk_grosscostlevel'       => ['name' => 'riskmngmt_risk_grosscostlevel',           'type' => 'int',      'internal' => 'grossCostLevel'],
        'riskmngmt_risk_grosscost'            => ['name' => 'riskmngmt_risk_grosscost',           'type' => 'Serializable',      'internal' => 'grossCost'],
        'riskmngmt_risk_grossexpectedcost'    => ['name' => 'riskmngmt_risk_grossexpectedcost',           'type' => 'Serializable',      'internal' => 'grossExpectedCost'],
        'riskmngmt_risk_netlikelihoodr'       => ['name' => 'riskmngmt_risk_netlikelihoodr',           'type' => 'float',      'internal' => 'netLikelihoodR'],
        'riskmngmt_risk_netlikelihoodlevel'   => ['name' => 'riskmngmt_risk_netlikelihoodlevel',           'type' => 'int',      'internal' => 'netLikelihoodLevel'],
        'riskmngmt_risk_netcostlevel'         => ['name' => 'riskmngmt_risk_netcostlevel',           'type' => 'int',      'internal' => 'netCostLevel'],
        'riskmngmt_risk_netcost'              => ['name' => 'riskmngmt_risk_netcost',           'type' => 'Serializable',      'internal' => 'netCost'],
        'riskmngmt_risk_netexpectedcost'      => ['name' => 'riskmngmt_risk_netexpectedcost',           'type' => 'Serializable',      'internal' => 'netExpectedCost'],
        'riskmngmt_risk_unit'                 => ['name' => 'riskmngmt_risk_unit',           'type' => 'int',      'internal' => 'unit'],
        'riskmngmt_risk_department'           => ['name' => 'riskmngmt_risk_department',     'type' => 'int',      'internal' => 'department'],
        'riskmngmt_risk_category'             => ['name' => 'riskmngmt_risk_category',       'type' => 'int',      'internal' => 'category'],
        'riskmngmt_risk_project'              => ['name' => 'riskmngmt_risk_project',        'type' => 'int',      'internal' => 'project'],
        'riskmngmt_risk_process'              => ['name' => 'riskmngmt_risk_process',        'type' => 'int',      'internal' => 'process'],
        'riskmngmt_risk_responsible'          => ['name' => 'riskmngmt_risk_responsible',    'type' => 'int',      'internal' => 'responsible'],
        'riskmngmt_risk_deputy'               => ['name' => 'riskmngmt_risk_deputy',         'type' => 'int',      'internal' => 'deputy'],
        'riskmngmt_risk_created_at'           => ['name' => 'riskmngmt_risk_created_at',     'type' => 'DateTimeImmutable', 'internal' => 'createdAt', 'readonly' => true],
    ];

    /**
     * Has many relation.
     *
     * @var array<string, array{mapper:class-string, table:string, self?:?string, external?:?string, column?:string}>
     * @since 1.0.0
     */
    public const HAS_MANY = [
        'files' => [
            'mapper'   => MediaMapper::class,
            'table'    => 'riskmngmt_risk_media',
            'external' => 'riskmngmt_risk_media_media',
            'self'     => 'riskmngmt_risk_media_risk',
        ],
        'riskObjects' => [
            'mapper'   => RiskObjectMapper::class,
            'table'    => 'riskmngmt_risk_object',
            'self'     => 'riskmngmt_risk_object_risk',
            'external' => null,
        ],
        'causes' => [
            'mapper'   => CauseMapper::class,
            'table'    => 'riskmngmt_cause',
            'self'     => 'riskmngmt_cause_risk',
            'external' => null,
        ],
        'solutions' => [
            'mapper'   => SolutionMapper::class,
            'table'    => 'riskmngmt_solution',
            'self'     => 'riskmngmt_solution_risk',
            'external' => null,
        ],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:class-string, external:string, column?:string, by?:string}>
     * @since 1.0.0
     */
    public const BELONGS_TO = [
        'responsible' => [
            'mapper'   => AccountMapper::class,
            'external' => 'riskmngmt_risk_responsible',
        ],
        'deputy' => [
            'mapper'   => AccountMapper::class,
            'external' => 'riskmngmt_risk_deputy',
        ],
        'project' => [
            'mapper'   => ProjectMapper::class,
            'external' => 'riskmngmt_risk_project',
        ],
        'process' => [
            'mapper'   => ProcessMapper::class,
            'external' => 'riskmngmt_risk_process',
        ],
        'category' => [
            'mapper'   => CategoryMapper::class,
            'external' => 'riskmngmt_risk_category',
        ],
        'department' => [
            'mapper'   => DepartmentMapper::class,
            'external' => 'riskmngmt_risk_department',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'riskmngmt_risk';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'riskmngmt_risk_id';
}
