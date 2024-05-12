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

use Modules\Organization\Models\DepartmentMapper;
use Modules\ProjectManagement\Models\ProjectMapper;
use Modules\RiskManagement\Models\CategoryMapper;
use Modules\RiskManagement\Models\CauseMapper;
use Modules\RiskManagement\Models\ProcessMapper;
use Modules\RiskManagement\Models\Risk;
use Modules\RiskManagement\Models\RiskMapper;
use Modules\RiskManagement\Models\RiskStatus;
use Modules\RiskManagement\Models\SolutionMapper;
use phpOMS\Stdlib\Base\FloatInt;

/**
 * @var \phpOMS\Views\View $this
 */
echo $this->data['nav']->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-9">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('TopRisks'); ?><i class="g-icon download btn end-xs">download</i></div>
            <div class="slider">
            <table class="default sticky">
                <thead>
                <tr>
                    <td><?= $this->getHtml('Severity'); ?>
                    <td class="wf-100"><?= $this->getHtml('Name'); ?>
                    <td><?= $this->getHtml('Department'); ?>
                    <td><?= $this->getHtml('Category'); ?>
                    <td><?= $this->getHtml('Process'); ?>
                    <td><?= $this->getHtml('Project'); ?>
                <tbody>
                <?php $c = 0;
                foreach ($this->data['toprisks'] as $key => $value) : ++$c;
                    $url = \phpOMS\Uri\UriFactory::build('{/base}/controlling/riskmanagement/risk/view?{?}&id=' . $value->id); ?>
                <tr>
                    <td><a href="<?= $url; ?>"><?= $this->getCurrency($value->netExpectedCost, symbol: '', format: 'medium'); ?></a>
                    <td><a href="<?= $url; ?>"><?= $this->printHtml($value->name); ?></a>
                    <td><a href="<?= $url; ?>"><?= $this->printHtml($value->department->name); ?></a>
                    <td><a href="<?= $url; ?>"><?= $this->printHtml($value->category?->getL11n()); ?></a>
                    <td><a href="<?= $url; ?>"><?= $this->printHtml($value->process?->title); ?></a>
                    <td><a href="<?= $url; ?>"><?= $this->printHtml($value->project?->name); ?></a>
                <?php endforeach; ?>
                <?php if ($c === 0) : ?>
                <tr><td colspan="6" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                <?php endif; ?>
            </table>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-3">
        <section class="portlet">
            <div class="portlet-body">
                <a tabindex="0" class="button" href="<?= \phpOMS\Uri\UriFactory::build('{/base}/controlling/riskmanagement/risk/create'); ?>"><?= $this->getHtml('NewRisk'); ?></a>
            </div>
        </section>

        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Statistics'); ?></div>
            <div class="portlet-body">
                <table class="list">
                    <thead>
                    <tr>
                        <th><?= $this->getHtml('Risks'); ?>
                        <td><?= RiskMapper::count()
                            ->where('unit', $this->data['unit'])
                            ->where('status', RiskStatus::ACTIVE)
                            ->executeCount(); ?>
                    <tr>
                        <th><?= $this->getHtml('Causes'); ?>
                        <td><?= CauseMapper::count()
                            ->with('risk')
                            ->where('risk/unit', $this->data['unit'])
                            ->executeCount(); ?>
                    <tr>
                        <th><?= $this->getHtml('Solutions'); ?>
                        <td><?= SolutionMapper::count()
                            ->with('risk')
                            ->where('risk/unit', $this->data['unit'])
                            ->executeCount(); ?>
                    <tr>
                        <th><?= $this->getHtml('Departments'); ?>
                        <td><?= DepartmentMapper::count()
                            ->where('unit', $this->data['unit'])
                            ->executeCount(); ?>
                    <tr>
                        <th><?= $this->getHtml('Categories'); ?>
                        <td><?= CategoryMapper::count()
                            ->executeCount(); ?>
                    <tr>
                        <th><?= $this->getHtml('Processes'); ?>
                        <td><?= ProcessMapper::count()
                            ->where('unit', $this->data['unit'])
                            ->executeCount(); ?>
                    <tr>
                        <th><?= $this->getHtml('Projects'); ?>
                        <td><?= ProjectMapper::count()
                            ->where('unit', $this->data['unit'])
                            ->executeCount(); ?>
                </table>
            </div>
        </section>
    </div>
</div>

<?php if (!empty($this->data['risks'])) : ?>
<div class="row">
    <div class="col-xs-12 col-md-6 col-lg-4">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Net'); ?><i class="g-icon download btn end-xs">download</i></div>
            <div class="portlet-body">
                <div style="position: relative; width: 100%; height: 100%; aspect-ratio: 1;">
                <canvas id="risk-net" data-chart='{
                    "type": "scatter",
                    "data": {
                        "labels": [
                            <?= '"' . \implode('", "', \array_map(function (Risk $risk) : string { return $risk->name; }, $this->data['risks'])) . '"'; ?>
                        ],
                        "datasets": [{
                            "data": [
                                <?php
                                    $temp = [];
                                    foreach ($this->data['risks'] as $risk) {
                                        $temp[] = '{"x": ' . ($risk->netCostLevel + \mt_rand(-100, 100) / 300)
                                            . ', "y": ' . ($risk->netLikelihoodLevel + \mt_rand(-100, 100) / 300) . '}';
                                    }
                                ?>
                                <?= \implode(',', $temp); ?>
                            ],
                            "yAxisID": "axis1",
                            "xAxisID": "axis2",
                            "backgroundColor": "rgb(54, 162, 235)"
                        }]
                    },
                    "options": {
                        "responsive": true,
                        "aspectRatio": 1,
                        "scales": {
                            "axis1": {
                                "id": "axis1",
                                "display": true,
                                "position": "left",
                                "min": 1,
                                "max": 5,
                                "ticks": {
                                    "stepSize": 1
                                },
                                "title": {
                                    "display": true,
                                    "text": "<?= $this->getHtml('Likelihood'); ?>"
                                },
                                "offset": true,
                                "grid": {
                                    "offset": true
                                }
                            },
                            "axis2": {
                                "id": "axis2",
                                "display": true,
                                "min": 1,
                                "max": 5,
                                "ticks": {
                                    "stepSize": 1
                                },
                                "title": {
                                    "display": true,
                                    "text": "<?= $this->getHtml('Severity'); ?>"
                                },
                                "offset": true,
                                "grid": {
                                    "offset": true
                                }
                            }
                        },
                        "plugins": {
                            "legend": {
                                "display": false
                            }
                        }
                    }
                }'></canvas>
                </div>
            </div>
        </section>
    </div>

    <div class="col-xs-12 col-md-6 col-lg-4">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Gross'); ?><i class="g-icon download btn end-xs">download</i></div>
            <div class="portlet-body">
                <div style="position: relative; width: 100%; height: 100%; aspect-ratio: 1;">
                <canvas id="risk-gross" data-chart='{
                    "type": "scatter",
                    "data": {
                        "labels": [
                            <?= '"' . \implode('", "', \array_map(function (Risk $risk) : string { return $risk->name; }, $this->data['risks'])) . '"'; ?>
                        ],
                        "datasets": [{
                            "data": [
                                <?php
                                    $temp = [];
                                    foreach ($this->data['risks'] as $risk) {
                                        $temp[] = '{"x": ' . ($risk->grossCostLevel + \mt_rand(-100, 100) / 300)
                                            . ', "y": ' . ($risk->grossLikelihoodLevel + \mt_rand(-100, 100) / 300) . '}';
                                    }
                                ?>
                                <?= \implode(',', $temp); ?>
                            ],
                            "yAxisID": "axis1",
                            "xAxisID": "axis2",
                            "backgroundColor": "rgb(54, 162, 235)"
                        }]
                    },
                    "options": {
                        "responsive": true,
                        "aspectRatio": 1,
                        "scales": {
                            "axis1": {
                                "id": "axis1",
                                "display": true,
                                "position": "left",
                                "min": 1,
                                "max": 5,
                                "ticks": {
                                    "stepSize": 1
                                },
                                "title": {
                                    "display": true,
                                    "text": "<?= $this->getHtml('Likelihood'); ?>"
                                },
                                "offset": true,
                                "grid": {
                                    "offset": true
                                }
                            },
                            "axis2": {
                                "id": "axis2",
                                "display": true,
                                "min": 1,
                                "max": 5,
                                "ticks": {
                                    "stepSize": 1
                                },
                                "title": {
                                    "display": true,
                                    "text": "<?= $this->getHtml('Severity'); ?>"
                                },
                                "offset": true,
                                "grid": {
                                    "offset": true
                                }
                            }
                        },
                        "plugins": {
                            "legend": {
                                "display": false
                            }
                        }
                    }
                }'></canvas>
                </div>
            </div>
        </section>
    </div>

    <?php if (!empty($this->data['history'])) : ?>
    <div class="col-xs-12 col-lg-4">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('History'); ?><i class="g-icon download btn end-xs">download</i></div>
            <div class="portlet-body">
            <div style="position: relative; width: 100%; height: 100%; aspect-ratio: 2;">
                <canvas id="risk-departments" data-chart='{
                    "type": "line",
                    "data": {
                        "labels": [
                            <?php
                                $temp = [];
                                foreach ($this->data['history'] as $history) {
                                    $temp[] = $history['year'] . '-' . $history['month'] . '-' . $history['day'];
                                }
                            ?>
                            <?= '"' . \implode('", "', $temp) . '"'; ?>
                        ],
                        "datasets": [{
                            "label": "Costs",
                            "type": "line",
                            "data": [
                                <?php
                                    $temp = [];
                                    foreach ($this->data['history'] as $history) {
                                        $temp[] = $history['net_costs'] / FloatInt::DIVISOR;
                                    }
                                ?>
                                <?= \implode(',', $temp); ?>
                            ],
                            "yAxisID": "axis1",
                            "backgroundColor": "rgb(54, 162, 235)"
                        }]
                    },
                    "options": {
                        "responsive": true,
                        "scales": {
                            "axis1": {
                                "id": "axis1",
                                "display": true,
                                "position": "left",
                                "suggestedMin": 0,
                                "ticks": {
                                    "precision": 0
                                }
                            }
                        },
                        "plugins": {
                            "legend": {
                                "display": false
                            }
                        }
                    }
                }'></canvas>
                </div>
            </div>
        </section>
    </div>
    <?php endif; ?>
</div>

<div class="row">
    <?php if (!empty($this->data['stats-departments'])) : ?>
    <div class="col-xs-12 col-md-6">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Departments'); ?><i class="g-icon download btn end-xs">download</i></div>
            <div class="portlet-body">
                <div style="position: relative; width: 100%; height: 100%; aspect-ratio: 2;">
                <canvas id="risk-departments" data-chart='{
                    "type": "bar",
                    "data": {
                        "labels": [
                            <?= '"' . \implode('", "', \array_keys($this->data['stats-departments'])) . '"'; ?>
                        ],
                        "datasets": [{
                            "label": "Costs",
                            "type": "bar",
                            "data": [
                                <?php
                                    $temp = [];
                                    foreach ($this->data['stats-departments'] as $department) {
                                        $costs = 0;
                                        foreach ($department as $risk) {
                                            $costs += $risk->netExpectedCost->value;
                                        }

                                        $temp[] = $costs / FloatInt::DIVISOR;
                                    }
                                ?>
                                <?= \implode(',', $temp); ?>
                            ],
                            "yAxisID": "axis1",
                            "backgroundColor": "rgb(54, 162, 235)"
                        }]
                    },
                    "options": {
                        "responsive": true,
                        "scales": {
                            "axis1": {
                                "id": "axis1",
                                "display": true,
                                "position": "left",
                                "suggestedMin": 0,
                                "ticks": {
                                    "precision": 0
                                }
                            }
                        },
                        "plugins": {
                            "legend": {
                                "display": false
                            }
                        }
                    }
                }'></canvas>
                </div>
            </div>
        </section>
    </div>
    <?php endif; ?>

    <?php if (!empty($this->data['stats-categories'])) : ?>
    <div class="col-xs-12 col-md-6">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Categories'); ?><i class="g-icon download btn end-xs">download</i></div>
            <div class="portlet-body">
                <div style="position: relative; width: 100%; height: 100%; aspect-ratio: 2;">
                <canvas id="risk-categories" data-chart='{
                    "type": "bar",
                    "data": {
                        "labels": [
                            <?= '"' . \implode('", "', \array_keys($this->data['stats-categories'])) . '"'; ?>
                        ],
                        "datasets": [{
                            "label": "Costs",
                            "type": "bar",
                            "data": [
                                <?php
                                    $temp = [];
                                    foreach ($this->data['stats-categories'] as $category) {
                                        $costs = 0;
                                        foreach ($category as $risk) {
                                            $costs += $risk->netExpectedCost->value;
                                        }

                                        $temp[] = $costs / FloatInt::DIVISOR;
                                    }
                                ?>
                                <?= \implode(',', $temp); ?>
                            ],
                            "yAxisID": "axis1",
                            "backgroundColor": "rgb(54, 162, 235)"
                        }]
                    },
                    "options": {
                        "responsive": true,
                        "scales": {
                            "axis1": {
                                "id": "axis1",
                                "display": true,
                                "position": "left",
                                "suggestedMin": 0,
                                "ticks": {
                                    "precision": 0
                                }
                            }
                        },
                        "plugins": {
                            "legend": {
                                "display": false
                            }
                        }
                    }
                }'></canvas>
                </div>
            </div>
        </section>
    </div>
    <?php endif; ?>

    <?php if (!empty($this->data['stats-departments'])) : ?>
    <div class="col-xs-12 col-md-6">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Departments'); ?><i class="g-icon download btn end-xs">download</i></div>
            <div class="portlet-body">
                <div style="position: relative; width: 100%; height: 100%; aspect-ratio: 1;">
                <canvas id="risk-departments" data-chart='{
                    "type": "pie",
                    "data": {
                        "labels": [
                            <?= '"' . \implode('", "', \array_keys($this->data['stats-departments'])) . '"'; ?>
                        ],
                        "datasets": [{
                            "data": [
                                <?php
                                    $temp = [];
                                    foreach ($this->data['stats-departments'] as $department) {
                                        $temp[] = \count($department);
                                    }
                                ?>
                                <?= \implode(',', $temp); ?>
                            ],
                            "backgroundColor": [
                                "#3498db", "#2ecc71", "#9b59b6", "#f1c40f", "#1abc9c",
                                "#34495e", "#e74c3c", "#e67e22", "#ecf0f1", "#95a5a6",
                                "#16a085", "#2980b9", "#8e44ad", "#2c3e50", "#27ae60", "#f39c12"
                            ]
                        }]
                    },
                    "options": {
                        "responsive": true,
                        "plugins": {
                            "legend": {
                                "display": true
                            }
                        }
                    }
                }'></canvas>
                </div>
            </div>
        </section>
    </div>
    <?php endif; ?>

    <?php if (!empty($this->data['stats-categories'])) : ?>
    <div class="col-xs-12 col-md-6">
        <section class="portlet">
            <div class="portlet-head"><?= $this->getHtml('Categories'); ?><i class="g-icon download btn end-xs">download</i></div>
            <div class="portlet-body">
                <div style="position: relative; width: 100%; height: 100%; aspect-ratio: 1;">
                <canvas id="risk-categories" data-chart='{
                    "type": "pie",
                    "data": {
                        "labels": [
                            <?= '"' . \implode('", "', \array_keys($this->data['stats-categories'])) . '"'; ?>
                        ],
                        "datasets": [{
                            "data": [
                                <?php
                                    $temp = [];
                                    foreach ($this->data['stats-categories'] as $category) {
                                        $temp[] = \count($category);
                                    }
                                ?>
                                <?= \implode(',', $temp); ?>
                            ],
                            "backgroundColor": [
                                "#3498db", "#2ecc71", "#9b59b6", "#f1c40f", "#1abc9c",
                                "#34495e", "#e74c3c", "#e67e22", "#ecf0f1", "#95a5a6",
                                "#16a085", "#2980b9", "#8e44ad", "#2c3e50", "#27ae60", "#f39c12"
                            ]
                        }]
                    },
                    "options": {
                        "responsive": true,
                        "plugins": {
                            "legend": {
                                "display": true
                            }
                        }
                    }
                }'></canvas>
                </div>
            </div>
        </section>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>