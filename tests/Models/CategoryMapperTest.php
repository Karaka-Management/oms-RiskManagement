<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
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
final class CategoryMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\CategoryMapper
     * @group module
     */
    public function testCRUD() : void
    {
        $obj                 = new Category();
        $obj->title          = 'Name';
        $obj->descriptionRaw = 'Description';
        $obj->responsible    = 1;
        $obj->deputy         = 1;

        CategoryMapper::create()->execute($obj);

        $objR = CategoryMapper::get()->where('id', $obj->getId())->execute();
        self::assertEquals($obj->title, $objR->title);
        self::assertEquals($obj->descriptionRaw, $objR->descriptionRaw);
        self::assertEquals($obj->responsible, $objR->responsible);
        self::assertEquals($obj->deputy, $objR->deputy);
    }
}
