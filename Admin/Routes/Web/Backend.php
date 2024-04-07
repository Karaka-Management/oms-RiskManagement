<?php
/**
 * Jingga
 *
 * PHP Version 8.2
 *
 * @package   Modules
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

use Modules\RiskManagement\Controller\BackendController;
use Modules\RiskManagement\Models\PermissionCategory;
use phpOMS\Account\PermissionType;
use phpOMS\Router\RouteVerb;

return [
    '^/controlling/riskmanagement/cockpit(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskCockpit',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::COCKPIT,
            ],
        ],
    ],
    '^/controlling/riskmanagement/risk/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskList',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::RISK,
            ],
        ],
    ],
    '^/controlling/riskmanagement/risk/create(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskCreate',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::RISK,
            ],
        ],
    ],
    '^/controlling/riskmanagement/risk/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskView',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::RISK,
            ],
        ],
    ],
    '^/controlling/riskmanagement/cause/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskCauseList',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::CAUSE,
            ],
        ],
    ],
    '^/controlling/riskmanagement/cause/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskCauseView',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::CAUSE,
            ],
        ],
    ],
    '^/controlling/riskmanagement/solution/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskSolutionList',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::SOLUTION,
            ],
        ],
    ],
    '^/controlling/riskmanagement/solution/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskSolutionView',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::SOLUTION,
            ],
        ],
    ],
    '^/controlling/riskmanagement/department/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskDepartmentList',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::DEPARTMENT,
            ],
        ],
    ],
    '^/controlling/riskmanagement/department/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskDepartmentView',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::DEPARTMENT,
            ],
        ],
    ],
    '^/controlling/riskmanagement/category/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskCategoryList',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::CATEGORY,
            ],
        ],
    ],
    '^/controlling/riskmanagement/category/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskCategoryView',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::CATEGORY,
            ],
        ],
    ],
    '^/controlling/riskmanagement/project/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskProjectList',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::PROJECT,
            ],
        ],
    ],
    '^/controlling/riskmanagement/project/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskProjectView',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::PROJECT,
            ],
        ],
    ],
    '^/controlling/riskmanagement/process/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskProcessList',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::PROCESS,
            ],
        ],
    ],
    '^/controlling/riskmanagement/process/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskProcessView',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::PROCESS,
            ],
        ],
    ],
    '^/controlling/riskmanagement/settings/dashboard(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskSettings',
            'verb'       => RouteVerb::GET,
            'active'     => true,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::SETTINGS,
            ],
        ],
    ],
];
