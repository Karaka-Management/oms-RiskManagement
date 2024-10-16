<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\RiskManagement\tests\Models;

use Modules\RiskManagement\Models\Category;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\RiskManagement\Models\Category::class)]
final class CategoryTest extends \PHPUnit\Framework\TestCase
{
    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testDefault() : void
    {
        $obj = new Category();

        self::assertEquals(0, $obj->id);
        self::assertEquals('', $obj->title);
        self::assertEquals('', $obj->description);
        self::assertEquals('', $obj->descriptionRaw);
        self::assertNull($obj->parent);
        self::assertNull($obj->responsible);
        self::assertNull($obj->deputy);
    }
}
