<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\RiskManagement\tests\Models;

use Modules\RiskManagement\Models\NullRisk;

/**
 * @internal
 */
final class NullRiskTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers \Modules\RiskManagement\Models\NullRisk
     * @group module
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\RiskManagement\Models\Risk', new NullRisk());
    }

    /**
     * @covers \Modules\RiskManagement\Models\NullRisk
     * @group module
     */
    public function testId() : void
    {
        $null = new NullRisk(2);
        self::assertEquals(2, $null->id);
    }

    /**
     * @covers \Modules\RiskManagement\Models\NullRisk
     * @group module
     */
    public function testJsonSerialize() : void
    {
        $null = new NullRisk(2);
        self::assertEquals(['id' => 2], $null->jsonSerialize());
    }
}
