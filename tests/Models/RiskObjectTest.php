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

use Modules\RiskManagement\Models\RiskObject;

/**
 * @internal
 */
class RiskObjectTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\RiskObject
     * @group module
     */
    public function testDefault() : void
    {
        $obj = new RiskObject();

        self::assertEquals(0, $obj->getId());
        self::assertEquals('', $obj->title);
        self::assertEquals('', $obj->description);
        self::assertEquals('', $obj->descriptionRaw);
        self::assertEquals(0, $obj->getRisk());
    }

    /**
     * @covers Modules\RiskManagement\Models\RiskObject
     * @group module
     */
    public function testSetGet() : void
    {
        $obj = new RiskObject();

        $obj->title = 'Name';
        self::assertEquals('Name', $obj->title);

        $obj->descriptionRaw = 'Description';
        self::assertEquals('Description', $obj->descriptionRaw);

        $obj->setRisk(1);
        self::assertEquals(1, $obj->getRisk());
    }
}
