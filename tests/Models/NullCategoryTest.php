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

use Modules\RiskManagement\Models\NullCategory;

/**
 * @internal
 */
final class NullCategoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\NullCategory
     * @group framework
     */
    public function testNull() : void
    {
        self::assertInstanceOf('\Modules\RiskManagement\Models\Category', new NullCategory());
    }

    /**
     * @covers Modules\RiskManagement\Models\NullCategory
     * @group framework
     */
    public function testId() : void
    {
        $null = new NullCategory(2);
        self::assertEquals(2, $null->getId());
    }
}
