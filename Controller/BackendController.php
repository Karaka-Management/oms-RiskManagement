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

use Modules\Organization\Models\DepartmentMapper;
use Modules\ProjectManagement\Models\ProjectMapper;
use Modules\RiskManagement\Models\CategoryMapper;
use Modules\RiskManagement\Models\CauseMapper;
use Modules\RiskManagement\Models\ProcessMapper;
use Modules\RiskManagement\Models\RiskHistoryMapper;
use Modules\RiskManagement\Models\RiskMapper;
use Modules\RiskManagement\Models\RiskStatus;
use Modules\RiskManagement\Models\SolutionMapper;
use phpOMS\Asset\AssetType;
use phpOMS\Contract\RenderableInterface;
use phpOMS\DataStorage\Database\Query\OrderType;
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
        $head  = $response->data['Content']->head;
        $nonce = $this->app->appSettings->getOption('script-nonce');

        $head->addAsset(AssetType::CSS, 'Resources/chartjs/chart.css?v=' . $this->app->version);
        $head->addAsset(AssetType::JSLATE, 'Resources/chartjs/chart.js?v=' . $this->app->version, ['nonce' => $nonce]);
        $head->addAsset(AssetType::JSLATE, 'Modules/RiskManagement/Controller/BackendController.js?v=' . self::VERSION, ['nonce' => $nonce, 'type' => 'module']);

        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/cockpit');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $view->data['toprisks'] = RiskMapper::getAll()
            ->with('department')
            ->with('category')
            ->with('process')
            ->with('project')
            ->where('unit', $this->app->unitId)
            ->where('status', RiskStatus::ACTIVE)
            ->sort('netExpectedCost', OrderType::DESC)
            ->limit(10)
            ->executeGetArray();

        $view->data['risks'] = RiskMapper::getAll()
            ->with('department')
            ->with('category')
            ->where('unit', $this->app->unitId)
            ->where('status', RiskStatus::ACTIVE)
            ->executeGetArray();

        $tmp = CategoryMapper::getAll()
            ->with('title')
            ->where('title/language', $request->header->l11n->language)
            ->executeGetArray();

        $view->data['categories'] = [];
        foreach ($tmp as $category) {
            $view->data['categories'][$category->id] = $category;
        }

        $view->data['unit'] = $this->app->unitId;

        $statsDepartments = [];
        $statsCategories = [];
        foreach ($view->data['risks'] as $risk) {
            if ($risk->department->id !== 0) {
                if (!isset($statsDepartments[$risk->department->name])) {
                    $statsDepartments[$risk->department->name] = [];
                }

                $statsDepartments[$risk->department->name][] = $risk;
            }

            if ($risk->category->id !== 0) {
                if (!isset($statsCategories[$view->data['categories'][$risk->category->id]->title])) {
                    $statsCategories[$view->data['categories'][$risk->category->id]->title] = [];
                }

                $statsCategories[$view->data['categories'][$risk->category->id]->title][] = $risk;
            }
        }

        $view->data['stats-departments'] = $statsDepartments;
        $view->data['stats-categories'] = $statsCategories;
        $view->data['history'] = RiskHistoryMapper::getHistory($this->app->unitId, new \DateTime(), new \DateTime());

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

        $causes               = CauseMapper::getAll()->with('risk')->execute();
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

        $solutions               = SolutionMapper::getAll()->with('risk')->with('cause')->execute();
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

        $view->data['solution'] = SolutionMapper::get()->where('id', (int) $request->getData('id'))->execute();

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

        $view->data['departments'] = DepartmentMapper::getAll()
            ->where('unit', $this->app->unitId)
            ->executeGetArray();

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

        $view->data['department'] = DepartmentMapper::get()
            ->where('id', (int) $request->getData('id'))
            ->execute();

        $view->data['risks'] = RiskMapper::getAll()
            ->with('category')
            ->with('category/title')
            ->with('project')
            ->with('process')
            ->where('department', (int) $request->getData('id'))
            ->where('category/title/language', $request->header->l11n->language)
            ->executeGetArray();

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

        $view->data['categories'] = CategoryMapper::getAll()
            ->with('title')
            ->where('title/language', $response->header->l11n->language)
            ->execute();

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

        $projects               = ProjectMapper::getAll()->executeGetArray();
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
