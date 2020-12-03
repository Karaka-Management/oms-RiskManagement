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

use Modules\RiskManagement\Models\Category;
use Modules\RiskManagement\Models\Cause;
use Modules\RiskManagement\Models\CauseMapper;
use Modules\RiskManagement\Models\Department;
use Modules\RiskManagement\Models\NullDepartment;
use Modules\Organization\Models\Department as OrgDepartment;
use Modules\Organization\Models\NullDepartment as NullOrgDepartment;
use Modules\RiskManagement\Models\Risk;
use Modules\Organization\Models\NullUnit;

/**
 * @internal
 */
class CauseMapperTest extends \PHPUnit\Framework\TestCase
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
        $obj->setProbability(1);

        $department = new Department();
        $department->department = new NullOrgDepartment(2);
        $obj->setDepartment($department);

        $category        = new Category();
        $category->title = 'Test Cat';
        $obj->setCategory($category);

        $risk       = new Risk();
        $risk->name = 'Cause Test Risk';
        $risk->setUnit(new NullUnit(1));
        $obj->setRisk($risk);

        CauseMapper::create($obj);

        /** @var Cause $objR */
        $objR = CauseMapper::get($obj->getId());
        self::assertEquals($obj->title, $objR->title);
        self::assertEquals($obj->descriptionRaw, $objR->descriptionRaw);
        //self::assertEquals($obj->getDepartment()->department->getId(), $objR->getDepartment()->department->getId());
        self::assertEquals($obj->getCategory()->title, $objR->getCategory()->title);
        self::assertEquals($obj->getRisk()->name, $objR->getRisk()->name);
    }
}
