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

use Modules\Admin\Models\NullAccount;
use Modules\Media\Models\Media;
use Modules\ProjectManagement\Models\NullProject;
use Modules\ProjectManagement\Models\ProgressType;
use Modules\ProjectManagement\Models\Project as PMProject;
use Modules\ProjectManagement\Models\ProjectMapper as PMProjectMapper;
use Modules\RiskManagement\Models\Project;
use Modules\RiskManagement\Models\ProjectMapper;
use Modules\Tasks\Models\Task;
use phpOMS\Stdlib\Base\FloatInt;

/**
 * @internal
 */
final class ProjectMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers \Modules\RiskManagement\Models\ProjectMapper
     * @group module
     */
    public function testCRUD() : void
    {
        $project = new PMProject();

        $project->setName('Projectname');
        $project->description = 'Description';
        $project->createdBy   = new NullAccount(1);
        $project->start       = new \DateTime('2000-05-05');
        $project->end         = new \DateTime('2005-05-05');

        $money = new FloatInt();
        $money->setString('1.23');

        $project->budgetCosts    = $money;
        $project->budgetEarnings = $money;
        $project->actualCosts    = $money;
        $project->actualEarnings = $money;

        $task        = new Task();
        $task->title = 'ProjectTask 1';
        $task->setCreatedBy(new NullAccount(1));

        $task2        = new Task();
        $task2->title = 'ProjectTask 2';
        $task2->setCreatedBy(new NullAccount(1));

        $project->tasks[] = $task;
        $project->tasks[] = $task2;

        $project->progress = 10;
        $project->setProgressType(ProgressType::TASKS);

        $media              = new Media();
        $media->createdBy   = new NullAccount(1);
        $media->description = 'desc';
        $media->setPath('some/path');
        $media->size      = 11;
        $media->extension = 'png';
        $media->name      = 'Project Media';
        $project->files[] = $media;

        $id = PMProjectMapper::create()->execute($project);

        $obj              = new Project();
        $obj->project     = new NullProject($id);
        $obj->responsible = 1;
        $obj->deputy      = 1;

        ProjectMapper::create()->execute($obj);

        $objR = ProjectMapper::get()->where('id', $obj->id)->execute();
        self::assertEquals($obj->project->id, $objR->project->id);
        self::assertEquals($obj->responsible, $objR->responsible);
        self::assertEquals($obj->deputy, $objR->deputy);
    }
}
