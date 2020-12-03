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

use Modules\RiskManagement\Models\Project;
use Modules\RiskManagement\Models\ProjectMapper;
use Modules\ProjectManagement\Models\NullProject;

/**
 * @internal
 */
class ProjectMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\ProjectMapper
     * @group module
     */
    public function testCRUD() : void
    {
        $obj = new Project();
        $obj->setProject(new NullProject(1));
        $obj->setResponsible(1);
        $obj->setDeputy(1);

        ProjectMapper::create($obj);

        $objR = ProjectMapper::get($obj->getId());
        self::assertEquals($obj->getProject()->getId(), $objR->getProject()->getId());
        self::assertEquals($obj->getResponsible(), $objR->getResponsible());
        self::assertEquals($obj->getDeputy(), $objR->getDeputy());
    }
}
