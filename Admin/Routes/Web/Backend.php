<?php
/**
 * Jingga
 *
 * PHP Version 8.1
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
    '^.*/riskmanagement/cockpit(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskCockpit',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::COCKPIT,
            ],
        ],
    ],
    '^.*/riskmanagement/risk/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::RISK,
            ],
        ],
    ],
    '^.*/riskmanagement/risk/create(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskCreate',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::CREATE,
                'state'  => PermissionCategory::RISK,
            ],
        ],
    ],
    '^.*/riskmanagement/risk/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::RISK,
            ],
        ],
    ],
    '^.*/riskmanagement/cause/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskCauseList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::CAUSE,
            ],
        ],
    ],
    '^.*/riskmanagement/cause/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskCauseView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::CAUSE,
            ],
        ],
    ],
    '^.*/riskmanagement/solution/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskSolutionList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::SOLUTION,
            ],
        ],
    ],
    '^.*/riskmanagement/solution/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskSolutionView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::SOLUTION,
            ],
        ],
    ],
    '^.*/riskmanagement/unit/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskUnitList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::UNIT,
            ],
        ],
    ],
    '^.*/riskmanagement/unit/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskUnitView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::UNIT,
            ],
        ],
    ],
    '^.*/riskmanagement/department/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskDepartmentList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::DEPARTMENT,
            ],
        ],
    ],
    '^.*/riskmanagement/department/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskDepartmentView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::DEPARTMENT,
            ],
        ],
    ],
    '^.*/riskmanagement/category/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskCategoryList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::CATEGORY,
            ],
        ],
    ],
    '^.*/riskmanagement/category/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskCategoryView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::CATEGORY,
            ],
        ],
    ],
    '^.*/riskmanagement/project/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskProjectList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::PROJECT,
            ],
        ],
    ],
    '^.*/riskmanagement/project/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskProjectView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::PROJECT,
            ],
        ],
    ],
    '^.*/riskmanagement/process/list(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskProcessList',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::PROCESS,
            ],
        ],
    ],
    '^.*/riskmanagement/process/view(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskProcessView',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::PROCESS,
            ],
        ],
    ],
    '^.*/riskmanagement/settings/dashboard(\?.*$|$)' => [
        [
            'dest'       => '\Modules\RiskManagement\Controller\BackendController:viewRiskSettings',
            'verb'       => RouteVerb::GET,
            'permission' => [
                'module' => BackendController::NAME,
                'type'   => PermissionType::READ,
                'state'  => PermissionCategory::SETTINGS,
            ],
        ],
    ],
];
