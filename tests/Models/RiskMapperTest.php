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

use Modules\Admin\Models\NullAccount;
use Modules\Media\Models\Media;
use Modules\Organization\Models\NullDepartment;
use Modules\Organization\Models\NullUnit;
use Modules\ProjectManagement\Models\NullProject;
use Modules\RiskManagement\Models\Category;
use Modules\RiskManagement\Models\Cause;
use Modules\RiskManagement\Models\Process;
use Modules\RiskManagement\Models\Project;
use Modules\RiskManagement\Models\Risk;
use Modules\RiskManagement\Models\RiskMapper;
use Modules\RiskManagement\Models\RiskObject;
use Modules\RiskManagement\Models\Solution;

/**
 * @internal
 */
final class RiskMapperTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Modules\RiskManagement\Models\RiskMapper
     * @group module
     */
    public function testCRUD() : void
    {
        $obj = new Risk();

        $obj->name           = 'Risk Test';
        $obj->descriptionRaw = 'Description';
        $obj->unit           = new NullUnit(1);
        $obj->department     = new NullDepartment(1);

        $categoryObj   = new Category();
        $obj->category = $categoryObj;

        $processObj   = new Process();
        $obj->process = $processObj;

        $projectObj          = new Project();
        $projectObj->project = new NullProject(1);
        $obj->project        = $projectObj;

        $obj->responsible = 1;
        $obj->deputy      = 1;

        $causeObj        = new Cause();
        $causeObj->title = 'Risk Test Cause';
        $obj->addCause($causeObj);

        $solutionObj        = new Solution();
        $solutionObj->title = 'Risk Test Solution';
        $obj->addSolution($solutionObj);

        $riskObj        = new RiskObject();
        $riskObj->title = 'Risk Test Object';
        $obj->addRiskObject($riskObj);

        $obj->addHistory(2);

        $media              = new Media();
        $media->createdBy   = new NullAccount(1);
        $media->description = 'desc';
        $media->setPath('some/path');
        $media->size      = 11;
        $media->extension = 'png';
        $media->name      = 'Image';
        $obj->addMedia($media);

        RiskMapper::create($obj);

        $objR = RiskMapper::get($obj->getId());
        self::assertEquals($obj->name, $objR->name);
        self::assertEquals($obj->descriptionRaw, $objR->descriptionRaw);
        self::assertEquals($obj->unit->getId(), $objR->unit->getId());
        self::assertEquals($obj->department->getId(), $objR->department->getId());
        self::assertEquals($obj->category->getId(), $objR->category->getId());
        self::assertEquals($obj->process->getId(), $objR->process->getId());
        self::assertEquals($obj->responsible, $objR->responsible);
        self::assertEquals($obj->deputy, $objR->deputy);
        self::assertEquals($obj->project->project->getId(), $objR->project->project->getId());

        $causes = $objR->getCauses();
        self::assertEquals($obj->getCauses()[0]->title, \end($causes)->title);

        $solutions = $objR->getSolutions();
        self::assertEquals($obj->getSolutions()[0]->title, \end($solutions)->title);

        $riskObjects = $objR->getRiskObjects();
        self::assertEquals($obj->getRiskObjects()[0]->title, \end($riskObjects)->title);

        //self::assertEquals($obj->getHistory()[0], $objR->getHistory()[0]);
        $media = $objR->getMedia();
        self::assertEquals($obj->getMedia()[0]->getPath(), \end($media)->getPath());
    }
}
