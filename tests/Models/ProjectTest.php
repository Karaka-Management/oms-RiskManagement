<?php
/**
 * Karaka
 *
 * PHP Version 8.0
 *
 * @package   tests
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://karaka.app
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

        self::assertEquals(0, $obj->getId());
        self::assertNull($obj->project);
        self::assertNull($obj->responsible);
        self::assertNull($obj->deputy);
    }
}
