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

use Modules\Admin\Models\NullAccount;
use Modules\Media\Models\Media;
use Modules\Organization\Models\NullDepartment;
use Modules\ProjectManagement\Models\NullProject;
use Modules\RiskManagement\Models\Category;
use Modules\RiskManagement\Models\Cause;
use Modules\RiskManagement\Models\Process;
use Modules\RiskManagement\Models\Risk;
use Modules\RiskManagement\Models\RiskMapper;
use Modules\RiskManagement\Models\RiskObject;
use Modules\RiskManagement\Models\Solution;

/**
 * @internal
 */
#[\PHPUnit\Framework\Attributes\CoversClass(\Modules\RiskManagement\Models\RiskMapper::class)]
final class RiskMapperTest extends \PHPUnit\Framework\TestCase
{
    #[\PHPUnit\Framework\Attributes\Group('module')]
    public function testCRUD() : void
    {
        $obj = new Risk();

        $obj->name           = 'Risk Test';
        $obj->descriptionRaw = 'Description';
        $obj->unit           = 1;
        $obj->department     = new NullDepartment(1);

        $categoryObj   = new Category();
        $obj->category = $categoryObj;

        $processObj   = new Process();
        $obj->process = $processObj;

        $obj->project        = new NullProject(1);

        $obj->responsible = 1;
        $obj->deputy      = 1;

        $causeObj        = new Cause();
        $causeObj->title = 'Risk Test Cause';
        $obj->causes[] = $causeObj;

        $solutionObj        = new Solution();
        $solutionObj->title = 'Risk Test Solution';
        $obj->solutions[] = $solutionObj;

        $riskObj        = new RiskObject();
        $riskObj->title = 'Risk Test Object';
        $obj->riskObjects[] = $riskObj;

        $obj->histScore[] = 2;

        $media              = new Media();
        $media->createdBy   = new NullAccount(1);
        $media->description = 'desc';
        $media->setPath('some/path');
        $media->size      = 11;
        $media->extension = 'png';
        $media->name      = 'Image';
        $obj->files[]     = $media;

        RiskMapper::create()->execute($obj);

        $objR = RiskMapper::get()->with('project')->with('project/project')->with('causes')->with('solutions')->with('riskObjects')->with('files')->where('id', $obj->id)->execute();
        self::assertEquals($obj->name, $objR->name);
        self::assertEquals($obj->descriptionRaw, $objR->descriptionRaw);
        self::assertEquals($obj->unit, $objR->unit);
        self::assertEquals($obj->department->id, $objR->department->id);
        self::assertEquals($obj->category->id, $objR->category->id);
        self::assertEquals($obj->process->id, $objR->process->id);
        self::assertEquals($obj->responsible, $objR->responsible);
        self::assertEquals($obj->deputy, $objR->deputy);
        self::assertEquals($obj->project->id, $objR->project->id);

        $causes = $objR->causes;
        self::assertEquals($obj->causes[0]->title, \end($causes)->title);

        $solutions = $objR->solutions;
        self::assertEquals($obj->solutions[0]->title, \end($solutions)->title);

        $riskObjects = $objR->riskObjects;
        self::assertEquals($obj->riskObjects[0]->title, \end($riskObjects)->title);

        //self::assertEquals($obj->getHistory()[0], $objR->getHistory()[0]);
        $media = $objR->files;
        self::assertEquals($obj->files[0]->getPath(), \end($media)->getPath());
    }
}
