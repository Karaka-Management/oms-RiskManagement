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

use Modules\RiskManagement\Models\RiskObject;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\RiskManagement\Models\RiskObject::class)]
final class RiskObjectTest extends \PHPUnit\Framework\TestCase
{
    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testDefault() : void
    {
        $obj = new RiskObject();

        self::assertEquals(0, $obj->id);
        self::assertEquals('', $obj->title);
        self::assertEquals('', $obj->description);
        self::assertEquals('', $obj->descriptionRaw);
        self::assertEquals(0, $obj->risk);
    }
}
