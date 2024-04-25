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
use Modules\Organization\Models\UnitMapper;
use Modules\ProjectManagement\Models\ProjectMapper;
use Modules\RiskManagement\Models\CategoryL11nMapper;
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

        /** @var \Modules\RiskManagement\Models\Category[] $tmp */
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
        $statsCategories  = [];
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
        $view->data['stats-categories']  = $statsCategories;
        $view->data['history']           = RiskHistoryMapper::getHistory($this->app->unitId, new \DateTime(), new \DateTime());

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

        $view->data['risks'] = RiskMapper::getAll()
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
    public function viewRiskView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/risk-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $view->data['risk'] = RiskMapper::get()
            ->where('id', (int) $request->getData('id'))
            ->execute();

        $view->data['units']      = UnitMapper::getAll()->executeGetArray();
        $view->data['categories'] = CategoryMapper::getAll()
            ->with('title')
            ->where('title/language', $response->header->l11n->language)
            ->executeGetArray();

        $view->data['departments'] = DepartmentMapper::getAll()
            ->where('unit', $this->app->unitId)
            ->executeGetArray();

        $view->data['processes'] = ProcessMapper::getAll()
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
    public function viewRiskCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/risk-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $view->data['units']      = UnitMapper::getAll()->executeGetArray();
        $view->data['categories'] = CategoryMapper::getAll()
            ->with('title')
            ->where('title/language', $response->header->l11n->language)
            ->executeGetArray();

        $view->data['departments'] = DepartmentMapper::getAll()
            ->where('unit', $this->app->unitId)
            ->executeGetArray();

        $view->data['processes'] = ProcessMapper::getAll()
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
    public function viewRiskCauseList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/cause-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $view->data['causes'] = CauseMapper::getAll()
            ->with('risk')
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
    public function viewRiskCauseView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/cause-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $view->data['cause'] = CauseMapper::get()
            ->where('id', (int) $request->getData('id'))
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
    public function viewRiskSolutionList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/solution-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $view->data['solutions'] = SolutionMapper::getAll()
            ->with('risk')
            ->with('cause')
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
    public function viewRiskSolutionView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/solution-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $view->data['solution'] = SolutionMapper::get()
            ->where('id', (int) $request->getData('id'))
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
    public function viewRiskProcessCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/process-view');
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
    public function viewRiskCategoryCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/category-view');
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
    public function viewRiskCategoryView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/category-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $view->data['category'] = CategoryMapper::get()
            ->with('title')
            ->where('id', (int) $request->getData('id'))
            ->where('title/language', $response->header->l11n->language)
            ->execute();

        $view->data['risks'] = RiskMapper::getAll()
            ->with('project')
            ->with('process')
            ->with('department')
            ->where('category', (int) $request->getData('id'))
            ->where('unit', $this->app->unitId)
            ->executeGetArray();

        /** @var \phpOMS\Localization\BaseStringL11n[] $l11nValues */
        $l11nValues = CategoryL11nMapper::getAll()
            ->where('ref', $view->data['category']->id)
            ->executeGetArray();

        $view->data['l11nView']   = new \Web\Backend\Views\L11nView($this->app->l11nManager, $request, $response);
        $view->data['l11nValues'] = $l11nValues;

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

        $view->data['projects'] = ProjectMapper::getAll()
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
    public function viewRiskProjectView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/project-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $view->data['project'] = ProjectMapper::get()
            ->where('id', (int) $request->getData('id'))
            ->execute();

        $view->data['risks'] = RiskMapper::getAll()
            ->with('project')
            ->with('process')
            ->with('department')
            ->where('category', (int) $request->getData('id'))
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
    public function viewRiskProcessList(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/process-list');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $view->data['processes'] = ProcessMapper::getAll()
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
    public function viewRiskProcessView(RequestAbstract $request, ResponseAbstract $response, array $data = []) : RenderableInterface
    {
        $view = new View($this->app->l11nManager, $request, $response);
        $view->setTemplate('/Modules/RiskManagement/Theme/Backend/process-view');
        $view->data['nav'] = $this->app->moduleManager->get('Navigation')->createNavigationMid(1003001001, $request, $response);

        $view->data['process'] = ProcessMapper::get()
            ->with('title')
            ->where('id', (int) $request->getData('id'))
            ->where('title/language', $response->header->l11n->language)
            ->execute();

        $view->data['risks'] = RiskMapper::getAll()
            ->with('project')
            ->with('process')
            ->with('department')
            ->where('process', (int) $request->getData('id'))
            ->where('unit', $this->app->unitId)
            ->executeGetArray();

        /*
        $l11nValues = ProcessL11nMapper::getAll()
            ->where('ref', $view->data['category']->id)
            ->executeGetArray();

        $view->data['l11nView']   = new \Web\Backend\Views\L11nView($this->app->l11nManager, $request, $response);
        $view->data['l11nValues'] = $l11nValues;
        */

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
