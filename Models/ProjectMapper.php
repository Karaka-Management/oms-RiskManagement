<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   Modules\RiskManagement\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://karaka.app
 */
declare(strict_types=1);

namespace Modules\RiskManagement\Models;

use phpOMS\DataStorage\Database\Mapper\DataMapperFactory;

/**
 * Risk project mapper class.
 *
 * @package Modules\RiskManagement\Models
 * @license OMS License 1.0
 * @link    https://karaka.app
 * @since   1.0.0
 */
final class ProjectMapper extends DataMapperFactory
{
    /**
     * Columns.
     *
     * @var array<string, array{name:string, type:string, internal:string, autocomplete?:bool, readonly?:bool, writeonly?:bool, annotations?:array}>
     * @since 1.0.0
     */
    public const COLUMNS = [
        'riskmngmt_project_id'          => ['name' => 'riskmngmt_project_id',          'type' => 'int', 'internal' => 'id'],
        'riskmngmt_project_project'     => ['name' => 'riskmngmt_project_project',     'type' => 'int', 'internal' => 'project'],
        'riskmngmt_project_responsible' => ['name' => 'riskmngmt_project_responsible', 'type' => 'int', 'internal' => 'responsible'],
        'riskmngmt_project_deputy'      => ['name' => 'riskmngmt_project_deputy',      'type' => 'int', 'internal' => 'deputy'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    public const TABLE = 'riskmngmt_project';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    public const PRIMARYFIELD ='riskmngmt_project_id';

    /**
     * Belongs to.
     *
     * @var array<string, array{mapper:string, external:string, column?:string, by?:string}>
     * @since 1.0.0
     */
    public const BELONGS_TO = [
        'project' => [
            'mapper'     => \Modules\ProjectManagement\Models\ProjectMapper::class,
            'external'   => 'riskmngmt_project_project',
        ],
    ];
}
