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

use Modules\RiskManagement\Models\Cause;
use Modules\RiskManagement\Models\Department;
use Modules\RiskManagement\Models\Risk;
use Modules\RiskManagement\Models\Solution;
use Modules\Organization\Models\NullUnit;
use Modules\Organization\Models\NullDepartment;
use Modules\RiskManagement\Models\NullCategory;
use Modules\RiskManagement\Models\NullProcess;

/**
 * @internal
 */
class RiskTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\Risk
     * @group module
     */
    public function testDefault() : void
    {
        $obj = new Risk();

        self::assertEquals(0, $obj->getId());
        self::assertEquals('', $obj->name);
        self::assertEquals('', $obj->description);
        self::assertEquals('', $obj->descriptionRaw);
        self::assertEquals(null, $obj->getUnit());
        self::assertNull($obj->getDepartment());
        self::assertNull($obj->getCategory());
        self::assertNull($obj->getProcess());
        self::assertNull($obj->getProject());
        self::assertNull($obj->getResponsible());
        self::assertNull($obj->getDeputy());
        self::assertEquals([], $obj->getHistory());
        self::assertEquals([], $obj->getCauses());
        self::assertEquals([], $obj->getSolutions());
        self::assertEquals([], $obj->getRiskObjects());
        self::assertEquals([], $obj->getMedia());
    }

    /**
     * @covers Modules\RiskManagement\Models\Risk
     * @group module
     */
    public function testSetGet() : void
    {
        $obj = new Risk();

        $obj->name = 'Name';
        self::assertEquals('Name', $obj->name);

        $obj->descriptionRaw = 'Description';
        self::assertEquals('Description', $obj->descriptionRaw);

        $obj->setUnit(new NullUnit(1));
        self::assertEquals(1, $obj->getUnit()->getId());

        $obj->setCategory(new NullCategory(3));
        self::assertEquals(3, $obj->getCategory()->getId());

        $obj->setProcess(new NullProcess(4));
        self::assertEquals(4, $obj->getProcess()->getId());

        $department = new Department();
        $department->department = new NullDepartment(1);
        $obj->setDepartment(new NullDepartment(1));

        $obj->setResponsible(1);
        self::assertEquals(1, $obj->getResponsible());

        $obj->setDeputy(1);
        self::assertEquals(1, $obj->getDeputy());

        $obj->addCause(new Cause());
        self::assertCount(1, $obj->getCauses());
        self::assertInstanceOf('\Modules\RiskManagement\Models\Cause', $obj->getCauses()[0]);

        $obj->addSolution(new Solution());
        self::assertCount(1, $obj->getSolutions());
        self::assertInstanceOf('\Modules\RiskManagement\Models\Solution', $obj->getSolutions()[0]);

        $obj->addRiskObject(2);
        self::assertCount(1, $obj->getRiskObjects());

        $obj->addHistory(2);
        self::assertCount(1, $obj->getHistory());

        $obj->addMedia(2);
        self::assertCount(1, $obj->getMedia());
    }
}
