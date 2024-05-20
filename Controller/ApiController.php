<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules\RiskManagement
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.2
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

namespace Modules\RiskManagement\Controller;

use Modules\Admin\Models\NullAccount;
use Modules\Organization\Models\NullDepartment;
use Modules\ProjectManagement\Models\NullProject;
use Modules\RiskManagement\Models\Category;
use Modules\RiskManagement\Models\CategoryL11nMapper;
use Modules\RiskManagement\Models\CategoryMapper;
use Modules\RiskManagement\Models\NullCategory;
use Modules\RiskManagement\Models\NullProcess;
use Modules\RiskManagement\Models\Process;
use Modules\RiskManagement\Models\ProcessMapper;
use Modules\RiskManagement\Models\Risk;
use Modules\RiskManagement\Models\RiskHistory;
use Modules\RiskManagement\Models\RiskHistoryMapper;
use Modules\RiskManagement\Models\RiskMapper;
use Modules\RiskManagement\Models\RiskStatus;
use phpOMS\Localization\BaseStringL11n;
use phpOMS\Localization\ISO639x1Enum;
use phpOMS\Message\Http\RequestStatusCode;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Stdlib\Base\FloatInt;

/**
 * RiskManagement api controller class.
 *
 * @package Modules\RiskManagement
 * @license OMS License 2.2
 * @link    https://jingga.app
 * @since   1.0.0
 */
final class ApiController extends Controller
{
    /**
     * Api method to remind a task
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiRiskCategoryCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateRiskCategoryCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $category = $this->createRiskCategoryFromRequest($request);
        $this->createModel($request->header->account, $category, CategoryMapper::class, 'category', $request->getOrigin());
        $this->createStandardCreateResponse($request, $response, $category);
    }

    /**
     * Validate category create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool> Returns the validation array of the request
     *
     * @since 1.0.0
     */
    private function validateRiskCategoryCreate(RequestAbstract $request) : array
    {
        $val = [];
        if ($val['title'] = !$request->hasData('title')) {
            return $val;
        }

        return [];
    }

    /**
     * Method to create category from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Category Returns the created category from the request
     *
     * @since 1.0.0
     */
    public function createRiskCategoryFromRequest(RequestAbstract $request) : Category
    {
        $category = new Category();

        $category->title = new BaseStringL11n($request->getDataString('name') ?? '');
        $category->setL11n(
            $request->getDataString('title') ?? '',
            ISO639x1Enum::tryFromValue($request->getDataString('language')) ?? ISO639x1Enum::_EN
        );

        return $category;
    }

    /**
     * Api method to create item material l11n
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiCategoryL11nCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateCategoryL11nCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $categoryL11n = $this->createCategoryL11nFromRequest($request);
        $this->createModel($request->header->account, $categoryL11n, CategoryL11nMapper::class, 'material_type_l11n', $request->getOrigin());
        $this->createStandardCreateResponse($request, $response, $categoryL11n);
    }

    /**
     * Validate material l11n create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool>
     *
     * @since 1.0.0
     */
    private function validateCategoryL11nCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = !$request->hasData('title'))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Method to create material l11n from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return BaseStringL11n
     *
     * @since 1.0.0
     */
    private function createCategoryL11nFromRequest(RequestAbstract $request) : BaseStringL11n
    {
        $categoryL11n           = new BaseStringL11n();
        $categoryL11n->ref      = $request->getDataInt('category') ?? 0;
        $categoryL11n->language = ISO639x1Enum::tryFromValue($request->getDataString('language')) ?? $request->header->l11n->language;
        $categoryL11n->content  = $request->getDataString('title') ?? '';

        return $categoryL11n;
    }

    /**
     * Api method to remind a task
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiRiskProcessCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateRiskProcessCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $process = $this->createRiskProcessFromRequest($request);
        $this->createModel($request->header->account, $process, ProcessMapper::class, 'process', $request->getOrigin());
        $this->createStandardCreateResponse($request, $response, $process);
    }

    /**
     * Validate process create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool> Returns the validation array of the request
     *
     * @since 1.0.0
     */
    private function validateRiskProcessCreate(RequestAbstract $request) : array
    {
        $val = [];
        if ($val['name']    = !$request->hasData('name')
            || $val['unit'] = !$request->hasData('unit')
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Method to create process from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Process Returns the created process from the request
     *
     * @since 1.0.0
     */
    public function createRiskProcessFromRequest(RequestAbstract $request) : Process
    {
        $process = new Process();

        $process->title      = $request->getDataString('name') ?? '';
        $process->unit       = $request->getDataInt('unit') ?? 1;
        $process->department = $request->hasData('department') ? new NullDepartment((int) $request->getData('department')) : null;

        return $process;
    }

    /**
     * Api method to remind a task
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiRiskCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateRiskCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        $risk = $this->createRiskFromRequest($request);
        $this->createModel($request->header->account, $risk, RiskMapper::class, 'risk', $request->getOrigin());
        $this->createStandardCreateResponse($request, $response, $risk);
    }

    /**
     * Validate risk create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool> Returns the validation array of the request
     *
     * @since 1.0.0
     */
    private function validateRiskCreate(RequestAbstract $request) : array
    {
        $val = [];
        if ($val['name']    = !$request->hasData('name')
            || $val['unit'] = !$request->hasData('unit')
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Method to create risk from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return Risk Returns the created risk from the request
     *
     * @since 1.0.0
     */
    public function createRiskFromRequest(RequestAbstract $request) : Risk
    {
        $risk = new Risk();

        $risk->name           = $request->getDataString('name') ?? '';
        $risk->descriptionRaw = $request->getDataString('description') ?? '';

        $risk->responsible = $request->hasData('responsible') ? new NullAccount((int) $request->getData('responsible')) : null;
        $risk->deputy      = $request->hasData('deputy') ? new NullAccount((int) $request->getData('deputy')) : null;

        $risk->unit       = $request->getDataInt('unit') ?? $this->app->unitId;
        $risk->category   = $request->hasData('category') ? new NullCategory((int) $request->getData('category')) : null;
        $risk->department = $request->hasData('department') ? new NullDepartment((int) $request->getData('department')) : null;
        $risk->process    = $request->hasData('process') ? new NullProcess((int) $request->getData('process')) : null;
        $risk->project    = $request->hasData('project') ? new NullProject((int) $request->getData('project')) : null;

        $risk->grossLikelihoodR     = $request->getDataFloat('grosslikelihoodratio') ?? 0.0;
        $risk->grossLikelihoodLevel = $request->getDataInt('grosslikelihoodlevel') ?? 0;
        $risk->grossCostLevel       = $request->getDataInt('grosscostlevel') ?? 0;
        $risk->grossCost            = new FloatInt($request->getDataString('grosscost') ?? 0);
        $risk->grossExpectedCost    = new FloatInt((int) ($risk->grossLikelihoodR / 100 * $risk->grossCost->value));

        $risk->netLikelihoodR     = $request->getDataFloat('netlikelihoodratio') ?? 0.0;
        $risk->netLikelihoodLevel = $request->getDataInt('netlikelihoodlevel') ?? 0;
        $risk->netCostLevel       = $request->getDataInt('netcostlevel') ?? 0;
        $risk->netCost            = new FloatInt($request->getDataString('netcost') ?? 0);
        $risk->netExpectedCost    = new FloatInt((int) ($risk->netLikelihoodR / 100 * $risk->netCost->value));

        return $risk;
    }

    /**
     * Api method to remind a task
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param array            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiRiskHistoryCreate(RequestAbstract $request, ResponseAbstract $response, array $data = []) : void
    {
        if (!empty($val = $this->validateRiskHistoryCreate($request))) {
            $response->header->status = RequestStatusCode::R_400;
            $this->createInvalidCreateResponse($request, $response, $val);

            return;
        }

        foreach ($this->createRiskHistoryFromRequest($request) as $history) {
            $this->createModel($request->header->account, $history, RiskHistoryMapper::class, 'risk_history', $request->getOrigin());
        }

        $this->createStandardCreateResponse($request, $response, []);
    }

    /**
     * Validate risk create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool> Returns the validation array of the request
     *
     * @since 1.0.0
     */
    private function validateRiskHistoryCreate(RequestAbstract $request) : array
    {
        $val = [];
        if ($val['unit'] = !$request->hasData('unit')
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Method to create risk from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return \Generator<RiskHistory> Returns the created risk from the request
     *
     * @since 1.0.0
     */
    public function createRiskHistoryFromRequest(RequestAbstract $request) : \Generator
    {
        $now = new \DateTimeImmutable('now');

        foreach (RiskMapper::yield()
            ->where('unit', (int) $request->getData('unit'))
            ->where('status', RiskStatus::ACTIVE)
            ->executeYield() as $risk
        ) {
            $history = new RiskHistory();

            $history->risk      = $risk;
            $history->unit      = $risk->unit;
            $history->createdAt = $now;

            $history->category   = $risk->category;
            $history->department = $risk->department;
            $history->process    = $risk->process;
            $history->project    = $risk->project;

            $history->grossLikelihoodR     = $risk->grossLikelihoodR;
            $history->grossLikelihoodLevel = $risk->grossLikelihoodLevel;
            $history->grossCostLevel       = $risk->grossCostLevel;
            $history->grossCost            = $risk->grossCost;
            $history->grossExpectedCost    = $risk->grossExpectedCost;

            $history->netLikelihoodR     = $risk->netLikelihoodR;
            $history->netLikelihoodLevel = $risk->netLikelihoodLevel;
            $history->netCostLevel       = $risk->netCostLevel;
            $history->netCost            = $risk->netCost;
            $history->netExpectedCost    = $risk->netExpectedCost;

            yield $history;
        }
    }
}
