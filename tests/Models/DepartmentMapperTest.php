<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\RiskManagement\tests\Models;

use Modules\Organization\Models\NullDepartment;
use Modules\RiskManagement\Models\Department;
use Modules\RiskManagement\Models\DepartmentMapper;

/**
 * @internal
 */
final class DepartmentMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\DepartmentMapper
     * @group module
     */
    public function testCRUD() : void
    {
        $obj              = new Department();
        $obj->department  = new NullDepartment();
        $obj->responsible = 1;
        $obj->deputy      = 1;

        DepartmentMapper::create()->execute($obj);

        $objR = DepartmentMapper::get()->where('id', $obj->id)->execute();
        self::assertEquals($obj->department->id, $objR->department->id);
        self::assertEquals($obj->responsible, $objR->responsible);
        self::assertEquals($obj->deputy, $objR->deputy);
    }
}
