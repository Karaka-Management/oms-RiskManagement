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
class RiskMapperTest extends \PHPUnit\Framework\TestCase
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
        $obj->setUnit(new NullUnit(1));
        $obj->setDepartment(new NullDepartment(2));

        $categoryObj = new Category();
        $obj->setCategory($categoryObj);

        $processObj = new Process();
        $obj->setProcess($processObj);

        $projectObj = new Project();
        $projectObj->setProject(new NullProject(1));
        $obj->setProject($projectObj);

        $obj->setResponsible(1);
        $obj->setDeputy(1);

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
        self::assertEquals($obj->getUnit()->getId(), $objR->getUnit()->getId());
        self::assertEquals($obj->getDepartment()->getId(), $objR->getDepartment()->getId());
        self::assertEquals($obj->getCategory()->getId(), $objR->getCategory()->getId());
        self::assertEquals($obj->getProcess()->getId(), $objR->getProcess()->getId());
        self::assertEquals($obj->getResponsible(), $objR->getResponsible());
        self::assertEquals($obj->getDeputy(), $objR->getDeputy());
        self::assertEquals($obj->getProject()->getProject()->getId(), $objR->getProject()->getProject()->getId());

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
