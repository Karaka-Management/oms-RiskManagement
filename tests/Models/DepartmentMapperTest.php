<?php
/**
 * Orange Management
 *
 * PHP Version 8.0
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\RiskManagement\tests\Models;

use Modules\Organization\Models\NullDepartment;
use Modules\RiskManagement\Models\Department;
use Modules\RiskManagement\Models\DepartmentMapper;

/**
 * @internal
 */
class DepartmentMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\DepartmentMapper
     * @group module
     */
    public function testCRUD() : void
    {
        $obj = new Department();
        $obj->department = new NullDepartment();
        $obj->setResponsible(1);
        $obj->setDeputy(1);

        DepartmentMapper::create($obj);

        $objR = DepartmentMapper::get($obj->getId());
        self::assertEquals($obj->department->getId(), $objR->department->getId());
        self::assertEquals($obj->getResponsible(), $objR->getResponsible());
        self::assertEquals($obj->getDeputy(), $objR->getDeputy());
    }
}
