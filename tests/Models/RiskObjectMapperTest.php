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

use Modules\RiskManagement\Models\RiskObject;
use Modules\RiskManagement\Models\RiskObjectMapper;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\RiskManagement\Models\RiskObjectMapper::class)]
final class RiskObjectMapperTest extends \PHPUnit\Framework\TestCase
{
    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testCRUD() : void
    {
        $obj                 = new RiskObject();
        $obj->title          = 'Name';
        $obj->descriptionRaw = 'Description';
        $obj->risk           = 1;

        RiskObjectMapper::create()->execute($obj);

        $objR = RiskObjectMapper::get()->where('id', $obj->id)->execute();
        self::assertEquals($obj->title, $objR->title);
        self::assertEquals($obj->descriptionRaw, $objR->descriptionRaw);
        self::assertEquals($obj->risk, $objR->risk);
    }
}
