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

use Modules\RiskManagement\Models\NullCause;

/**
 * @internal
 */
final class NullCauseTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\NullCause
     * @group framework
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\RiskManagement\Models\Cause', new NullCause());
    }

    /**
     * @covers Modules\RiskManagement\Models\NullCause
     * @group framework
     */
    public function testId() : void
    {
        $null = new NullCause(2);
        self::assertEquals(2, $null->getId());
    }
}
