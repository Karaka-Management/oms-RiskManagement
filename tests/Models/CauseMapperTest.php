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

use Modules\Organization\Models\NullDepartment as NullOrgDepartment;
use Modules\Organization\Models\NullUnit;
use Modules\RiskManagement\Models\Category;
use Modules\RiskManagement\Models\Cause;
use Modules\RiskManagement\Models\CauseMapper;
use Modules\RiskManagement\Models\Risk;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\RiskManagement\Models\CauseMapper::class)]
final class CauseMapperTest extends \PHPUnit\Framework\TestCase
{
    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testCRUD() : void
    {
        $obj                 = new Cause();
        $obj->title          = 'Cause Test';
        $obj->descriptionRaw = 'Description';
        $obj->probability    = 1;
        $obj->department        = new NullOrgDepartment(1);

        $category        = new Category();
        $category->title = 'Test Cat';
        $obj->category   = $category;

        $risk       = new Risk();
        $risk->name = 'Cause Test Risk';
        $risk->unit = 1;
        $obj->risk  = $risk;

        CauseMapper::create()->execute($obj);

        /** @var Cause $objR */
        $objR = CauseMapper::get()->with('risk')->with('category')->where('id', $obj->id)->execute();
        self::assertGreaterThan(0, $objR->id);
        self::assertEquals($obj->title, $objR->title);
        self::assertEquals($obj->descriptionRaw, $objR->descriptionRaw);
        //self::assertEquals($obj->getDepartment()->department->id, $objR->getDepartment()->department->id);
        self::assertEquals($obj->category->title, $objR->category->title);
        self::assertEquals($obj->risk->name, $objR->risk->name);
    }
}
