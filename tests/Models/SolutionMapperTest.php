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

use Modules\RiskManagement\Models\Solution;
use Modules\RiskManagement\Models\SolutionMapper;
use Modules\RiskManagement\Models\NullCause;
use Modules\RiskManagement\Models\NullRisk;

/**
 * @internal
 */
class SolutionMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\SolutionMapper
     * @group module
     */
    public function testCRUD() : void
    {
        $obj = new Solution();

        $obj->title          = 'Title';
        $obj->descriptionRaw = 'Description';
        $obj->setProbability(1);
        $obj->setCause(new NullCause(1));
        $obj->setRisk(new NullRisk(1));

        SolutionMapper::create($obj);

        $objR = SolutionMapper::get($obj->getId());
        self::assertEquals($obj->title, $objR->title);
        self::assertEquals($obj->descriptionRaw, $objR->descriptionRaw);
        self::assertEquals($obj->getProbability(), $objR->getProbability());
        self::assertEquals($obj->getRisk()->getId(), $objR->getRisk()->getId());
        self::assertEquals($obj->getCause()->getId(), $objR->getCause()->getId());
    }
}
