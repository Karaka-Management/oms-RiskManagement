<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\RiskManagement
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\RiskManagement\Controller;

use Modules\Organization\Models\UnitMapper;
use Modules\RiskManagement\Models\CategoryMapper;
use Modules\RiskManagement\Models\CauseMapper;
use Modules\RiskManagement\Models\DepartmentMapper;
use Modules\RiskManagement\Models\ProcessMapper;
use Modules\RiskManagement\Models\ProjectMapper;
use Modules\RiskManagement\Models\RiskMapper;
use Modules\RiskManagement\Models\SolutionMapper;
use phpOMS\Contract\RenderableInterface;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Views\View;

/**
 * Risk Management class.
 *
 * @package Modules\RiskManagement
 * @license OMS License 2.0
 * @link    https://jingga.app
 * @since   1.0.0
 * @codeCoverageIgnore
 */
final class BackendController extends Controller
{
    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewRiskCockpit(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/cockpit');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewRiskList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/risk-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $risks               = RiskMapper::getAll()->execute();
        $view->data['risks'] = $risks;

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewRiskView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/risk-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $risk               = RiskMapper::get()->where('id', (int) $request->getData('id'))->execute();
        $view->data['risk'] = $risk;

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewRiskCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/risk-create');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewRiskCauseList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/cause-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $causes               = CauseMapper::getAll()->execute();
        $view->data['causes'] = $causes;

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewRiskCauseView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/cause-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $cause               = CauseMapper::get()->where('id', (int) $request->getData('id'))->execute();
        $view->data['cause'] = $cause;

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewRiskSolutionList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/solution-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $solutions               = SolutionMapper::getAll()->execute();
        $view->data['solutions'] = $solutions;

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewRiskSolutionView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/solution-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $solution               = SolutionMapper::get()->where('id', (int) $request->getData('id'))->execute();
        $view->data['solution'] = $solution;

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewRiskUnitList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/unit-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $units               = UnitMapper::getAll()->execute();
        $view->data['units'] = $units;

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewRiskUnitView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/unit-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $unit               = UnitMapper::get()->where('id', (int) $request->getData('id'))->execute();
        $view->data['unit'] = $unit;

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewRiskDepartmentList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/department-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $departments               = DepartmentMapper::getAll()->execute();
        $view->data['departments'] = $departments;

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewRiskDepartmentView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/department-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $department               = DepartmentMapper::get()->where('id', (int) $request->getData('id'))->execute();
        $view->data['department'] = $department;

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewRiskCategoryList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/category-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $categories               = CategoryMapper::getAll()->execute();
        $view->data['categories'] = $categories;

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewRiskCategoryView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/category-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $category               = CategoryMapper::get()->where('id', (int) $request->getData('id'))->execute();
        $view->data['category'] = $category;

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewRiskProjectList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/project-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $projects               = ProjectMapper::getAll()->execute();
        $view->data['projects'] = $projects;

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewRiskProjectView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/project-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $project               = ProjectMapper::get()->where('id', (int) $request->getData('id'))->execute();
        $view->data['project'] = $project;

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewRiskProcessList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/process-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $processes               = ProcessMapper::getAll()->execute();
        $view->data['processes'] = $processes;

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewRiskProcessView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/process-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $process               = ProcessMapper::get()->where('id', (int) $request->getData('id'))->execute();
        $view->data['process'] = $process;

        return $view;
    }

    /**
     * Routing end-point for application behavior.
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return RenderableInterface
     *
     * @since 1.0.0
     * @codeCoverageIgnore
     */
    public function viewRiskSettings(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/settings-dashboard');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        return $view;
    }
}
