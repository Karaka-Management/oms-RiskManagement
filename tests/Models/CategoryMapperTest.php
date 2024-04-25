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
use Modules\RiskManagement\Models\CategoryMapper;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\RiskManagement\Models\CategoryMapper::class)]
final class CategoryMapperTest extends \PHPUnit\Framework\TestCase
{
    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testCRUD() : void
    {
        $obj                 = new Category();
        $obj->title          = 'Name';
        $obj->responsible    = 1;
        $obj->deputy         = 1;

        CategoryMapper::create()->execute($obj);

        $objR = CategoryMapper::get()->where('id', $obj->id)->execute();
        self::assertEquals($obj->title, $objR->title);
        self::assertEquals($obj->responsible, $objR->responsible);
        self::assertEquals($obj->deputy, $objR->deputy);
    }
}
