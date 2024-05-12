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

use phpOMS\Uri\UriFactory;

$risks = $this->data['risks'];
echo $this->data['nav']->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <section class="portlet">
            <div class="portlet-head">
                <?= $this->getHtml('Risks'); ?>
                <i class="g-icon download btn end-xs">download</i>
                <a class="button end-xs save" href="<?= UriFactory::build('{/base}/controlling/riskmanagement/risk/create'); ?>"><?= $this->getHtml('New', '0', '0'); ?></a>
            </div>
            <div class="slider">
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
                foreach ($risks as $key => $value) : ++$c;
                    $url = \phpOMS\Uri\UriFactory::build('{/base}/controlling/riskmanagement/risk/view?{?}&id=' . $value->id); ?>
                <tr tabindex="0" data-href="<?= $url; ?>">
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
            </div>
        </section>
    </div>
</div>