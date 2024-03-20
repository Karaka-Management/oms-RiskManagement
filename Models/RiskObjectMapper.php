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
 * Risk object mapper class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 *
 * @template T of RiskObject
 * @extends DataMapperFactory<T>
 */
final class RiskObjectMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'riskmngmt_risk_object_id'             => ['name' => 'riskmngmt_risk_object_id',             'type' => 'int',    'internal' => 'id'],
        'riskmngmt_risk_object_name'           => ['name' => 'riskmngmt_risk_object_name',           'type' => 'string', 'internal' => 'title'],
        'riskmngmt_risk_object_description'    => ['name' => 'riskmngmt_risk_object_description',    'type' => 'string', 'internal' => 'description'],
        'riskmngmt_risk_object_descriptionraw' => ['name' => 'riskmngmt_risk_object_descriptionraw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'riskmngmt_risk_object_risk'           => ['name' => 'riskmngmt_risk_object_risk',           'type' => 'int',    'internal' => 'risk'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'riskmngmt_risk_object';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD = 'riskmngmt_risk_object_id';
}
