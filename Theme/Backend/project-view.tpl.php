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

use Modules\ProjectManagement\Models\NullProject;

$project = $this->data['project'] ?? new NullProject();
$isNew   = $project->id === 0;

echo $this->data['nav']->render();
?>

<div class="tabview tab-2">
    <?php if (!$isNew) : ?>
    <div class="box">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $this->getHtml('Project'); ?></label>
            <li><label for="c-tab-2"><?= $this->getHtml('Risks'); ?></label>
        </ul>
    </div>
    <?php endif; ?>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-2"<?= $isNew || $this->request->uri->fragment === 'c-tab-1' ? ' checked' : ''; ?>>
        <div class="tab">
        </div>

        <?php if (!$isNew) : ?>
        <input type="radio" id="c-tab-2" name="tabular-2"<?= $this->request->uri->fragment === 'c-tab-2' ? ' checked' : ''; ?>>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12">
                    <section class="portlet">
                        <div class="portlet-head"><?= $this->getHtml('Risks'); ?><i class="g-icon download btn end-xs">download</i></div>
                        <table class="default sticky">
                            <thead>
                            <tr>
                                <td><?= $this->getHtml('ID', '0', '0'); ?>
                                <td class="wf-100"><?= $this->getHtml('Title'); ?>
                                <td><?= $this->getHtml('Causes'); ?>
                                <td><?= $this->getHtml('Solutions'); ?>
                                <td><?= $this->getHtml('RiskObjects'); ?>
                            <tbody>
                            <?php $c = 0;
                            foreach ($this->data['risks'] as $key => $value) : ++$c;
                                $url = \phpOMS\Uri\UriFactory::build('{/base}/controlling/riskmanagement/cause/view?{?}&id=' . $value->id); ?>
                            <tr data-href="<?= $url; ?>">
                                <td><a href="<?= $url; ?>"><?= $value->id; ?></a>
                                <td><a href="<?= $url; ?>"><?= $this->printHtml($value->name); ?></a>
                                <td><a href="<?= $url; ?>"><?= \count($value->causes); ?></a>
                                <td><a href="<?= $url; ?>"><?= \count($value->solutions); ?></a>
                                <td><a href="<?= $url; ?>"><?= \count($value->riskObjects); ?></a>
                            <?php endforeach; ?>
                            <?php if ($c === 0) : ?>
                            <tr><td colspan="5" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                            <?php endif; ?>
                        </table>
                    </section>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>