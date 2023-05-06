<?php
/**
 * Karaka
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

use Modules\RiskManagement\Models\Project;

/**
 * @internal
 */
final class ProjectTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\Project
     * @group module
     */
    public function testDefault() : void
    {
        $obj = new Project();

        self::assertEquals(0, $obj->id);
        self::assertNull($obj->project);
        self::assertNull($obj->responsible);
        self::assertNull($obj->deputy);
    }
}
