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

use Modules\RiskManagement\Models\Process;

/**
 * @internal
 */
final class ProcessTest extends \PHPUnit\Framework\TestCase
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
        self::assertNull($obj->department);
        self::assertNull($obj->unit);
        self::assertNull($obj->responsible);
        self::assertNull($obj->deputy);
    }
}
