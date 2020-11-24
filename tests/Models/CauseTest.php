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

use Modules\RiskManagement\Models\Cause;

/**
 * @internal
 */
class CauseTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\Cause
     * @group module
     */
    public function testDefault() : void
    {
        $obj = new Cause();

        self::assertEquals(0, $obj->getId());
        self::assertEquals('', $obj->title);
        self::assertEquals('', $obj->description);
        self::assertEquals('', $obj->descriptionRaw);
        self::assertEquals(0, $obj->getProbability());
        self::assertNull($obj->getDepartment());
        self::assertNull($obj->getRisk());
        self::assertNull($obj->getCategory());
    }

    /**
     * @covers Modules\RiskManagement\Models\Cause
     * @group module
     */
    public function testSetGet() : void
    {
        $obj = new Cause();

        $obj->title = 'Name';
        self::assertEquals('Name', $obj->title);

        $obj->descriptionRaw = 'Description';
        self::assertEquals('Description', $obj->descriptionRaw);

        $obj->setProbability(1);
        self::assertEquals(1, $obj->getProbability());

        $obj->setCategory(2);
        self::assertEquals(2, $obj->getCategory());

        $obj->setRisk(1);
        self::assertEquals(1, $obj->getRisk());

        $obj->setDepartment(1);
        self::assertEquals(1, $obj->getDepartment());
    }
}
