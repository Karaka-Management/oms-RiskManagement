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

use Modules\RiskManagement\Models\NullCause;
use Modules\RiskManagement\Models\NullRisk;
use Modules\RiskManagement\Models\Solution;
use Modules\RiskManagement\Models\SolutionMapper;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\RiskManagement\Models\SolutionMapper::class)]
final class SolutionMapperTest extends \PHPUnit\Framework\TestCase
{
    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testCRUD() : void
    {
        $obj = new Solution();

        $obj->title          = 'Title';
        $obj->descriptionRaw = 'Description';
        $obj->probability    = 1;
        $obj->cause          = new NullCause(1);
        $obj->risk           = new NullRisk(1);

        SolutionMapper::create()->execute($obj);

        $objR = SolutionMapper::get()->where('id', $obj->id)->execute();
        self::assertEquals($obj->title, $objR->title);
        self::assertEquals($obj->descriptionRaw, $objR->descriptionRaw);
        self::assertEquals($obj->probability, $objR->probability);
        self::assertEquals($obj->risk->id, $objR->risk->id);
        self::assertEquals($obj->cause->id, $objR->cause->id);
    }
}
