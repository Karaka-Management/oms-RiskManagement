<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\RiskManagement\tests\Models;

use Modules\RiskManagement\Models\Process;
use Modules\Organization\Models\NullUnit;
use Modules\RiskManagement\Models\NullDepartment;

/**
 * @internal
 */
class ProcessTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\Process
     * @group module
     */
    public function testDefault() : void
    {
        $obj = new Process();

        self::assertEquals(0, $obj->getId());
        self::assertEquals('', $obj->title);
        self::assertEquals('', $obj->description);
        self::assertEquals('', $obj->descriptionRaw);
        self::assertNull($obj->getDepartment());
        self::assertEquals(null, $obj->getUnit());
        self::assertNull($obj->getResponsible());
        self::assertNull($obj->getDeputy());
    }

    /**
     * @covers Modules\RiskManagement\Models\Process
     * @group module
     */
    public function testSetGet() : void
    {
        $obj = new Process();

        $obj->title = 'Name';
        self::assertEquals('Name', $obj->title);

        $obj->descriptionRaw = 'Description';
        self::assertEquals('Description', $obj->descriptionRaw);

        $obj->setResponsible(1);
        self::assertEquals(1, $obj->getResponsible());

        $obj->setDeputy(1);
        self::assertEquals(1, $obj->getDeputy());

        $obj->setUnit(new NullUnit(1));
        self::assertEquals(1, $obj->getUnit()->getId());

        $obj->setDepartment(new NullDepartment(2));
        self::assertEquals(2, $obj->getDepartment()->getId());
    }
}
