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
     * @covers \Modules\RiskManagement\Models\ProcessMapper
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

        $objR = ProcessMapper::get()->where('id', $obj->id)->execute();
        self::assertEquals($obj->title, $objR->title);
        self::assertEquals($obj->descriptionRaw, $objR->descriptionRaw);
        self::assertEquals($obj->responsible, $objR->responsible);
        self::assertEquals($obj->deputy, $objR->deputy);
        self::assertEquals($obj->department->id, $objR->department->id);
        self::assertEquals($obj->unit->id, $objR->unit->id);
    }
}
