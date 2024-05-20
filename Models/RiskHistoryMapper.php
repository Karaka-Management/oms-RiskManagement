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

use Modules\Organization\Models\DepartmentMapper;
use Modules\ProjectManagement\Models\ProjectMapper;
use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;
use phpOMS\DataStorage\Database\Query\Builder;

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
final class RiskHistoryMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'riskmngmt_history_id'                   => ['name' => 'riskmngmt_history_id',             'type' => 'int',      'internal' => 'id'],
        'riskmngmt_history_grosslikelihoodr'     => ['name' => 'riskmngmt_history_grosslikelihoodr',           'type' => 'float',      'internal' => 'grossLikelihoodR'],
        'riskmngmt_history_grosslikelihoodlevel' => ['name' => 'riskmngmt_history_grosslikelihoodlevel',           'type' => 'int',      'internal' => 'grossLikelihoodLevel'],
        'riskmngmt_history_grosscostlevel'       => ['name' => 'riskmngmt_history_grosscostlevel',           'type' => 'int',      'internal' => 'grossCostLevel'],
        'riskmngmt_history_grosscost'            => ['name' => 'riskmngmt_history_grosscost',           'type' => 'Serializable',      'internal' => 'grossCost'],
        'riskmngmt_history_grossexpectedcost'    => ['name' => 'riskmngmt_history_grossexpectedcost',           'type' => 'Serializable',      'internal' => 'grossExpectedCost'],
        'riskmngmt_history_netlikelihoodr'       => ['name' => 'riskmngmt_history_netlikelihoodr',           'type' => 'float',      'internal' => 'netLikelihoodR'],
        'riskmngmt_history_netlikelihoodlevel'   => ['name' => 'riskmngmt_history_netlikelihoodlevel',           'type' => 'int',      'internal' => 'netLikelihoodLevel'],
        'riskmngmt_history_netcostlevel'         => ['name' => 'riskmngmt_history_netcostlevel',           'type' => 'int',      'internal' => 'netCostLevel'],
        'riskmngmt_history_netcost'              => ['name' => 'riskmngmt_history_netcost',           'type' => 'Serializable',      'internal' => 'netCost'],
        'riskmngmt_history_netexpectedcost'      => ['name' => 'riskmngmt_history_netexpectedcost',           'type' => 'Serializable',      'internal' => 'netExpectedCost'],
        'riskmngmt_history_unit'                 => ['name' => 'riskmngmt_history_unit',           'type' => 'int',      'internal' => 'unit'],
        'riskmngmt_history_department'           => ['name' => 'riskmngmt_history_department',     'type' => 'int',      'internal' => 'department'],
        'riskmngmt_history_category'             => ['name' => 'riskmngmt_history_category',       'type' => 'int',      'internal' => 'category'],
        'riskmngmt_history_project'              => ['name' => 'riskmngmt_history_project',        'type' => 'int',      'internal' => 'project'],
        'riskmngmt_history_process'              => ['name' => 'riskmngmt_history_process',        'type' => 'int',      'internal' => 'process'],
        'riskmngmt_history_created_at'           => ['name' => 'riskmngmt_history_created_at',     'type' => 'DateTimeImmutable', 'internal' => 'createdAt', 'readonly' => true],
    ];

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:class-string, external:string, column?:string, by?:string}>
     * @since 1.0.0
     */
    public const BELONGS_TO = [
        'project' => [
            'mapper'   => ProjectMapper::class,
            'external' => 'riskmngmt_history_project',
        ],
        'process' => [
            'mapper'   => ProcessMapper::class,
            'external' => 'riskmngmt_history_process',
        ],
        'category' => [
            'mapper'   => CategoryMapper::class,
            'external' => 'riskmngmt_history_category',
        ],
        'department' => [
            'mapper'   => DepartmentMapper::class,
            'external' => 'riskmngmt_history_department',
        ],
        'risk' => [
            'mapper'   => RiskMapper::class,
            'external' => 'riskmngmt_history_risk',
        ],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'riskmngmt_history';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'riskmngmt_history_id';

    /**
     * Placeholder
     */
    public static function getHistory(int $unit, \DateTime $start, \DateTime $end) : array
    {
        $query  = new Builder(self::$db);
        $result = $query->selectAs('SUM(riskmngmt_history_netexpectedcost)', 'net_costs')
            ->selectAs('YEAR(riskmngmt_history_created_at)', 'year')
            ->selectAs('MONTH(riskmngmt_history_created_at)', 'month')
            ->selectAs('DAY(riskmngmt_history_created_at)', 'day')
            ->from(self::TABLE)
            ->where(self::TABLE . '.riskmngmt_history_unit', '=', $unit)
            ->groupBy('year', 'month', 'day')
            ->orderBy(['year', 'month', 'day'], ['ASC', 'ASC', 'ASC'])
            ->execute()
            ?->fetchAll();

        return $result ?? [];
    }
}
