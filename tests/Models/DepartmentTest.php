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

use Modules\Organization\Models\NullDepartment as NullOrgDepartment;
use Modules\RiskManagement\Models\Department;

/**
 * @internal
 */
final class DepartmentTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\Department
     * @group module
     */
    public function testDefault() : void
    {
        $obj = new Department();

        self::assertEquals(0, $obj->getId());
        self::assertNull($obj->department);
        self::assertNull($obj->getResponsible());
        self::assertNull($obj->getDeputy());
    }

    /**
     * @covers Modules\RiskManagement\Models\Department
     * @group module
     */
    public function testSetGet() : void
    {
        $obj = new Department();

        $obj->department = new NullOrgDepartment(1);
        self::assertEquals(1, $obj->department->getId());

        $obj->setResponsible(1);
        self::assertEquals(1, $obj->getResponsible());

        $obj->setDeputy(3);
        self::assertEquals(3, $obj->getDeputy());
    }
}
