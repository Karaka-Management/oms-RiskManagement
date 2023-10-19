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

$categories = $this->data['categories'];
echo $this->data['nav']->render(); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box wf-100">
            <div class="slider">
            <table class="default sticky">
                <caption><?= $this->getHtml('Categories'); ?><i class="g-icon end-xs download btn">download</i></caption>
                <thead>
                <tr>
                    <td><?= $this->getHtml('ID', '0', '0'); ?>
                    <td class="wf-100"><?= $this->getHtml('Title'); ?>
                        <tfoot>
                <tr><td colspan="3">
                        <tbody>
                        <?php $c = 0; foreach ($categories as $key => $value) : ++$c;
                        $url     = \phpOMS\Uri\UriFactory::build('riskmanagement/category/single?{?}&id=' . $value->id); ?>
                <tr tabindex="0" data-href="<?= $url; ?>">
                    <td><a href="<?= $url; ?>"><?= $value->id; ?></a>
                    <td><a href="<?= $url; ?>"><?= $this->printHtml($value->getTitle()); ?></a>
                        <?php endforeach; ?>
                        <?php if ($c === 0) : ?>
                        <tr><td colspan="3" class="empty"><?= $this->getHtml('Empty', '0', '0'); ?>
                                <?php endif; ?>
            </table>
            </div>
        </div>
    </div>
</div>