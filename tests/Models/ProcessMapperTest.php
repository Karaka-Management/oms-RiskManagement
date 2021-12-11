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

use Modules\Organization\Models\NullUnit;
use Modules\RiskManagement\Models\NullDepartment;
use Modules\RiskManagement\Models\Process;
use Modules\RiskManagement\Models\ProcessMapper;

/**
 * @internal
 */
final class ProcessMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\ProcessMapper
     * @group module
     */
    public function testCRUD() : void
    {
        $obj                 = new Process();
        $obj->title          = 'Name';
        $obj->descriptionRaw = 'Description';
        $obj->department     = new NullDepartment(1);
        $obj->responsible    = 1;
        $obj->deputy         = 1;
        $obj->unit           = new NullUnit(1);

        ProcessMapper::create()->execute($obj);

        $objR = ProcessMapper::get()->where('id', $obj->getId())->execute();
        self::assertEquals($obj->title, $objR->title);
        self::assertEquals($obj->descriptionRaw, $objR->descriptionRaw);
        self::assertEquals($obj->responsible, $objR->responsible);
        self::assertEquals($obj->deputy, $objR->deputy);
        self::assertEquals($obj->department->getId(), $objR->department->getId());
        self::assertEquals($obj->unit->getId(), $objR->unit->getId());
    }
}
