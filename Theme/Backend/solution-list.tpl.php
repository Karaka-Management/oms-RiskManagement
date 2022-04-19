<?php
/**
 * Karaka
 *
 * PHP Version 8.1
 *
 * @package   Modules\RiskManagement
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://karaka.app
 */
declare(strict_types=1);

$solutions = $this->getData('solutions');

echo $this->getData('nav')->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <div class="slider">
            <table class="default sticky">
                <caption><?= $this->getHtml('Solutions'); ?><i class="fa fa-download floatRight download btn"></i></caption>
                <thead>
                <tr>
                    <td><?= $this->getHtml('ID', '0', '0'); ?>
                    <td class="wf-100"><?= $this->getHtml('Title'); ?>
                    <td><?= $this->getHtml('Risk'); ?>
                    <td><?= $this->getHtml('Cause'); ?>
                        <tfoot>
                <tr><td colspan="4">
                        <tbody>
                        <?php $c = 0; foreach ($solutions as $key => $value) : ++$c;
                        $url     = \phpOMS\Uri\UriFactory::build('{/prefix}riskmanagement/solution/single?{?}&id=' . $value->getId()); ?>
                <tr tabindex="0" data-href="<?= $url; ?>">
                    <td><a href="<?= $url; ?>"><?= $value->getId(); ?></a>
                    <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getTitle()); ?></a>
                    <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getRisk()->getName()); ?></a>
                    <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getCause()->getTitle()); ?></a>
                        <?php endforeach; ?>
                        <?php if ($c === 0) : ?>
                        <tr><td colspan="4" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                                <?php endif; ?>
            </table>
            </div>
        </div>
    </div>
</div>