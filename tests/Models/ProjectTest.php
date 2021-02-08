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

use Modules\ProjectManagement\Models\NullProject;
use Modules\RiskManagement\Models\Project;

/**
 * @internal
 */
class ProjectTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\Project
     * @group module
     */
    public function testDefault() : void
    {
        $obj = new Project();

        self::assertEquals(0, $obj->getId());
        self::assertNull($obj->getProject());
        self::assertNull($obj->getResponsible());
        self::assertNull($obj->getDeputy());
    }

    /**
     * @covers Modules\RiskManagement\Models\Project
     * @group module
     */
    public function testSetGet() : void
    {
        $obj = new Project();

        $obj->setResponsible(1);
        self::assertEquals(1, $obj->getResponsible());

        $obj->setDeputy(1);
        self::assertEquals(1, $obj->getDeputy());

        $obj->setProject(new NullProject(1));
        self::assertEquals(1, $obj->getProject()->getId());
    }
}
