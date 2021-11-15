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

/**
 * @internal
 */
final class CauseTest extends \PHPUnit\Framework\TestCase
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
        self::assertEquals(0, $obj->probability);
        self::assertNull($obj->department);
        self::assertNull($obj->risk);
        self::assertNull($obj->category);
    }
}
