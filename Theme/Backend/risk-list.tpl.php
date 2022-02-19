<?php
/**
 * Karaka
 *
 * PHP Version 8.0
 *
 * @package   Modules\RiskManagement
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://karaka.app
 */
declare(strict_types=1);

$risks = $this->getData('risks');
echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <div class="slider">
            <table class="default sticky">
                <caption><?= $this->getHtml('Risks'); ?><i class="fa fa-download floatRight download btn"></i></caption>
                <thead>
                <tr>
                    <td><?= $this->getHtml('ID', '0', '0'); ?>
                    <td class="wf-100"><?= $this->getHtml('Title'); ?>
                    <td><?= $this->getHtml('Causes'); ?>
                    <td><?= $this->getHtml('Solutions'); ?>
                    <td><?= $this->getHtml('RiskObjects'); ?>
                        <tfoot>
                <tr><td colspan="5">
                        <tbody>
                        <?php $c = 0; foreach ($risks as $key => $value) : ++$c;
                        $url     = \phpOMS\Uri\UriFactory::build('{/prefix}riskmanagement/risk/single?{?}&id=' . $value->getId()); ?>
                <tr tabindex="0" data-href="<?= $url; ?>">
                    <td><a href="<?= $url; ?>"><?= $value->getId(); ?></a>
                    <td><a href="<?= $url; ?>"><?= $this->printHtml($value->name); ?></a>
                    <td><a href="<?= $url; ?>"><?= $this->printHtml(\count($value->getCauses())); ?></a>
                    <td><a href="<?= $url; ?>"><?= $this->printHtml(\count($value->getSolutions())); ?></a>
                    <td><a href="<?= $url; ?>"><?= $this->printHtml(\count($value->getRiskObjects())); ?></a>
                        <?php endforeach; ?>
                        <?php if ($c === 0) : ?>
                        <tr><td colspan="5" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                                <?php endif; ?>
            </table>
            </div>
        </div>
    </div>
</div>