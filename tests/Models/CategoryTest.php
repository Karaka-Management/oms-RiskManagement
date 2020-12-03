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

use Modules\RiskManagement\Models\Category;

/**
 * @internal
 */
class CategoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\Category
     * @group module
     */
    public function testDefault() : void
    {
        $obj = new Category();

        self::assertEquals(0, $obj->getId());
        self::assertEquals('', $obj->title);
        self::assertEquals('', $obj->description);
        self::assertEquals('', $obj->descriptionRaw);
        self::assertNull($obj->parent);
        self::assertNull($obj->responsible);
        self::assertNull($obj->deputy);
    }

    /**
     * @covers Modules\RiskManagement\Models\Category
     * @group module
     */
    public function testSetGet() : void
    {
        $obj = new Category();

        $obj->title = 'Name';
        self::assertEquals('Name', $obj->title);

        $obj->descriptionRaw = 'Description';
        self::assertEquals('Description', $obj->descriptionRaw);

        $obj->responsible = 1;
        self::assertEquals(1, $obj->responsible);

        $obj->deputy = 1;
        self::assertEquals(1, $obj->deputy);

        $obj->parent = 1;
        self::assertEquals(1, $obj->parent);
    }
}
