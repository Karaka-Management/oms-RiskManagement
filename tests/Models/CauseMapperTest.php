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
 * @link      https://karaka.app
 */
declare(strict_types=1);

namespace Modules\RiskManagement\tests\Models;

use Modules\Organization\Models\NullDepartment as NullOrgDepartment;
use Modules\Organization\Models\NullUnit;
use Modules\RiskManagement\Models\Category;
use Modules\RiskManagement\Models\Cause;
use Modules\RiskManagement\Models\CauseMapper;
use Modules\RiskManagement\Models\Department;
use Modules\RiskManagement\Models\Risk;

/**
 * @internal
 */
final class CauseMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\CauseMapper
     * @group module
     */
    public function testCRUD() : void
    {
        $obj                 = new Cause();
        $obj->title          = 'Cause Test';
        $obj->descriptionRaw = 'Description';
        $obj->probability    = 1;

        $department             = new Department();
        $department->department = new NullOrgDepartment(1);
        $obj->department        = $department;

        $category        = new Category();
        $category->title = 'Test Cat';
        $obj->category   = $category;

        $risk       = new Risk();
        $risk->name = 'Cause Test Risk';
        $risk->unit = new NullUnit(1);
        $obj->risk  = $risk;

        CauseMapper::create()->execute($obj);

        /** @var Cause $objR */
        $objR = CauseMapper::get()->with('risk')->with('category')->where('id', $obj->getId())->execute();
        self::assertEquals($obj->title, $objR->title);
        self::assertEquals($obj->descriptionRaw, $objR->descriptionRaw);
        //self::assertEquals($obj->getDepartment()->department->getId(), $objR->getDepartment()->department->getId());
        self::assertEquals($obj->category->title, $objR->category->title);
        self::assertEquals($obj->risk->name, $objR->risk->name);
    }
}
