<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\RiskManagement\tests\Models;

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
        self::assertNull($obj->responsible);
        self::assertNull($obj->deputy);
    }
}
