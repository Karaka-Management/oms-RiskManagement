<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\RiskManagement\tests\Models;

use Modules\Organization\Models\NullDepartment;
use Modules\RiskManagement\Models\Process;
use Modules\RiskManagement\Models\ProcessMapper;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\RiskManagement\Models\ProcessMapper::class)]
final class ProcessMapperTest extends \PHPUnit\Framework\TestCase
{
    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testCRUD() : void
    {
        $obj              = new Process();
        $obj->title       = 'Name';
        $obj->department  = new NullDepartment(1);
        $obj->responsible = 1;
        $obj->deputy      = 1;
        $obj->unit        = 1;

        ProcessMapper::create()->execute($obj);

        $objR = ProcessMapper::get()->where('id', $obj->id)->execute();
        self::assertGreaterThan(0, $objR->id);
        self::assertEquals($obj->title, $objR->title);
        self::assertEquals($obj->responsible, $objR->responsible);
        self::assertEquals($obj->deputy, $objR->deputy);
        self::assertEquals($obj->department->id, $objR->department->id);
        self::assertEquals($obj->unit, $objR->unit);
    }
}
