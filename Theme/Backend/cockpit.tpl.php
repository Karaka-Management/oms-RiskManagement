<?php
/**
 * Jingga
 *
 * PHP Version 8.1
 *
 * @package   Modules\RiskManagement
 * @copyright Dennis Eichhorn
 * @license   OMS License 2.0
 * @version   1.0.0
 * @link      https://jingga.app
 */
declare(strict_types=1);

/**
 * @var \phpOMS\Views\View $this
 */

$footerView = new \phpOMS\Views\PaginationView($this->l11nManager, $this->request, $this->response);
$footerView->setTemplate('/Web/Templates/Lists/Footer/PaginationBig');

$footerView->setPages(25);
$footerView->setPage(1);
$footerView->setResults(1);

echo $this->data['nav']->render(); ?>

<div class="row">
    <div class="col-xs-12 col-md-9">
        <div class="box wf-100">
            <table class="default sticky">
                <caption><?= $this->getHtml('TopRisks'); ?><i class="g-icon end-xs download btn">download</i></caption>
                <thead>
                <tr>
                    <td><?= $this->getHtml('Severity'); ?>
                    <td class="wf-100"><?= $this->getHtml('Name'); ?>
                    <td><?= $this->getHtml('Department'); ?>
                    <td><?= $this->getHtml('Category'); ?>
                    <td><?= $this->getHtml('Process'); ?>
                    <td><?= $this->getHtml('Project'); ?>
                    <td><?= $this->getHtml('Unit'); ?>
                <tfoot>
                <tr><td colspan="6">
                <tbody>
                <?php $c = 0; foreach ([] as $key => $value) : ++$c;
                $url     = \phpOMS\Uri\UriFactory::build('{/base}/admin/group/settings?{?}&id=' . $value->id); ?>
                <tr>
                    <td><a href="<?= $url; ?>"><?= $value->id; ?></a>
                    <td><a href="<?= $url; ?>"><?= $this->printHtml($value->name); ?></a>
                    <td>
                    <td>
                    <td>
                    <td>
                        <?php endforeach; ?>
                        <?php if ($c === 0) : ?>
                <tr><td colspan="7" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                        <?php endif; ?>
            </table>
        </div>
    </div>

    <div class="col-xs-12 col-md-3">
        <section class="box wf-100">
            <div class="inner">
                <a tabindex="0" class="button" href="<?= \phpOMS\Uri\UriFactory::build('riskmanagement/risk/create'); ?>"><?= $this->getHtml('NewRisk'); ?></a>
            </div>
        </section>

        <section class="box wf-100">
            <header><h1><?= $this->getHtml('Statistics'); ?></h1></header>
            <div class="inner">
                <table class="list">
                    <thead>
                    <tr>
                        <th><?= $this->getHtml('Risks'); ?>
                        <td>0
                    <tr>
                        <th><?= $this->getHtml('Causes'); ?>
                        <td>0
                    <tr>
                        <th><?= $this->getHtml('Solutions'); ?>
                        <td>0
                    <tr>
                        <th><?= $this->getHtml('Department'); ?>
                        <td>0
                    <tr>
                        <th><?= $this->getHtml('Category'); ?>
                        <td>0
                    <tr>
                        <th><?= $this->getHtml('Process'); ?>
                        <td>0
                    <tr>
                        <th><?= $this->getHtml('Project'); ?>
                        <td>0
                    <tr>
                        <th><?= $this->getHtml('Total'); ?>
                        <td>0
                </table>
            </div>
        </section>
    </div>
</div>

