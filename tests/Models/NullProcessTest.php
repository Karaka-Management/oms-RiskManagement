<?php
/**
 * Karaka
 *
 * PHP Version 8.0
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://karaka.app
 */
declare(strict_types=1);

namespace Modules\RiskManagement\tests\Models;

use Modules\RiskManagement\Models\NullProcess;

/**
 * @internal
 */
final class NullProcessTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\NullProcess
     * @group framework
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\RiskManagement\Models\Process', new NullProcess());
    }

    /**
     * @covers Modules\RiskManagement\Models\NullProcess
     * @group framework
     */
    public function testId() : void
    {
        $null = new NullProcess(2);
        self::assertEquals(2, $null->getId());
    }
}
