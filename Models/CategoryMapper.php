<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    TBD
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\RiskManagement\Models;

use phpOMS\DataStorage\Database\DataMapperAbstract;

final class CategoryMapper extends DataMapperAbstract
{
    /**
     * Columns.
     *
     * @var array<string, array<string, bool|string>>
     * @since 1.0.0
     */
    protected static $columns = [
        'riskmngmt_category_id'             => ['name' => 'riskmngmt_category_id', 'type' => 'int', 'internal' => 'id'],
        'riskmngmt_category_name'           => ['name' => 'riskmngmt_category_name', 'type' => 'string', 'internal' => 'title'],
        'riskmngmt_category_description'    => ['name' => 'riskmngmt_category_description', 'type' => 'string', 'internal' => 'description'],
        'riskmngmt_category_descriptionraw' => ['name' => 'riskmngmt_category_descriptionraw', 'type' => 'string', 'internal' => 'descriptionRaw'],
        'riskmngmt_category_parent'         => ['name' => 'riskmngmt_category_parent', 'type' => 'int', 'internal' => 'parent'],
        'riskmngmt_category_responsible'    => ['name' => 'riskmngmt_category_responsible', 'type' => 'int', 'internal' => 'responsible'],
        'riskmngmt_category_deputy'         => ['name' => 'riskmngmt_category_deputy', 'type' => 'int', 'internal' => 'deputy'],
    ];

    /**
     * Primary table.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $table = 'riskmngmt_category';

    /**
     * Primary field name.
     *
     * @var string
     * @since 1.0.0
     */
    protected static $primaryField = 'riskmngmt_category_id';
}
