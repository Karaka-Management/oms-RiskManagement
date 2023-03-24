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

use Modules\ProjectManagement\Models\NullProject;
use Modules\RiskManagement\Models\Project;
use Modules\RiskManagement\Models\ProjectMapper;

/**
 * @internal
 */
final class ProjectMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\ProjectMapper
     * @group module
     */
    public function testCRUD() : void
    {
        $obj              = new Project();
        $obj->project     = new NullProject(1);
        $obj->responsible = 1;
        $obj->deputy      = 1;

        ProjectMapper::create()->execute($obj);

        $objR = ProjectMapper::get()->where('id', $obj->getId())->execute();
        self::assertEquals($obj->project->getId(), $objR->project->getId());
        self::assertEquals($obj->responsible, $objR->responsible);
        self::assertEquals($obj->deputy, $objR->deputy);
    }
}
