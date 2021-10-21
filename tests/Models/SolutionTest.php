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

use Modules\RiskManagement\Models\NullCause;
use Modules\RiskManagement\Models\NullRisk;
use Modules\RiskManagement\Models\Solution;

/**
 * @internal
 */
final class SolutionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\Solution
     * @group module
     */
    public function testDefault() : void
    {
        $obj = new Solution();

        self::assertEquals(0, $obj->getId());
        self::assertEquals('', $obj->title);
        self::assertEquals('', $obj->description);
        self::assertEquals('', $obj->descriptionRaw);
        self::assertEquals(0, $obj->getProbability());
        self::assertEquals(0, $obj->getCause());
        self::assertEquals(0, $obj->getRisk());
    }

    /**
     * @covers Modules\RiskManagement\Models\Solution
     * @group module
     */
    public function testSetGet() : void
    {
        $obj = new Solution();

        $obj->title = 'Title';
        self::assertEquals('Title', $obj->title);

        $obj->descriptionRaw = 'Description';
        self::assertEquals('Description', $obj->descriptionRaw);

        $obj->setProbability(1);
        self::assertEquals(1, $obj->getProbability());

        $obj->setCause(new NullCause(1));
        self::assertEquals(1, $obj->getCause()->getId());

        $obj->setRisk(new NullRisk(1));
        self::assertEquals(1, $obj->getRisk()->getId());
    }
}
