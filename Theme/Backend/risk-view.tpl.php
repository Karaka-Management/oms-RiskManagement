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

use Modules\RiskManagement\Models\NullRisk;

$risk = $this->data['risk'] ?? new NullRisk();
$isNew = $risk->id === 0;

echo $this->data['nav']->render(); ?>
<div class="tabview tab-2">
    <?php if (!$isNew) : ?>
    <div class="box">
        <ul class="tab-links">
            <li><label for="c-tab-1"><?= $this->getHtml('Risk'); ?></label>
            <li><label for="c-tab-2"><?= $this->getHtml('RiskStatus'); ?></label>
            <li><label for="c-tab-3"><?= $this->getHtml('RiskObjects'); ?></label>
            <li><label for="c-tab-4"><?= $this->getHtml('RiskObjectStatus'); ?></label>
            <li><label for="c-tab-5"><?= $this->getHtml('Solutions'); ?></label>
        </ul>
    </div>
    <?php endif; ?>
    <div class="tab-content">
        <input type="radio" id="c-tab-1" name="tabular-2"<?= $isNew || $this->request->uri->fragment === 'c-tab-1' ? ' checked' : ''; ?>>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <section class="portlet">
                        <form id="fRisk"  method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/api}controlling/riskmanagement?{?}&csrf={$CSRF}'); ?>">
                        <div class="portlet-head"><?= $this->getHtml('Risk'); ?></div>
                            <div class="portlet-body">
                                <div class="form-group">
                                    <label for="iId"><?= $this->getHtml('ID', '0', '0'); ?></label>
                                    <input type="text" name="id" id="iId" value="<?= $risk->id; ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="iName"><?= $this->getHtml('Name'); ?></label>
                                    <input type="text" name="name" id="iName" value="<?= $this->printHtml($risk->name); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="iDescription"><?= $this->getHtml('Description'); ?></label>
                                    <textarea name="description" id="iDescription"><?= $this->printTextarea($risk->description); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="iUnit"><?= $this->getHtml('Unit'); ?></label>
                                    <select id="iUnit" name="unit">
                                        <option value="">
                                        <?php
                                        foreach ($this->data['units'] as $unit) : ?>
                                            <option value="<?= $unit->id; ?>"<?= $unit->id === $risk->unit ? ' selected' : ''; ?>><?= $this->printHtml($unit->name); ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="iCategory"><?= $this->getHtml('Category'); ?></label>
                                    <select id="iCategory" name="category">
                                        <option value="">
                                        <?php
                                        foreach ($this->data['categories'] as $category) : ?>
                                            <option value="<?= $category->id; ?>"<?= $category->id === $risk->category->id ? ' selected' : ''; ?>><?= $this->printHtml($category->getL11n()); ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="iDepartment"><?= $this->getHtml('Department'); ?></label>
                                    <select id="iDepartment" name="department">
                                        <option value="">
                                        <?php
                                        foreach ($this->data['departments'] as $department) : ?>
                                            <option value="<?= $department->id; ?>"<?= $department->id === $risk->department->id ? ' selected' : ''; ?>><?= $this->printHtml($department->name); ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="iProcess"><?= $this->getHtml('Process'); ?></label>
                                    <select id="iProcess" name="process">
                                        <option value="">
                                        <?php
                                        foreach ($this->data['processes'] as $process) : ?>
                                            <option value="<?= $process->id; ?>"<?= $process->id === $risk->process->id ? ' selected' : ''; ?>><?= $this->printHtml($process->title); ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="portlet-foot">
                                <?php if ($isNew) : ?>
                                    <input id="iCreateSubmit" type="Submit" value="<?= $this->getHtml('Create', '0', '0'); ?>">
                                <?php else : ?>
                                    <input id="iSaveSubmit" type="Submit" value="<?= $this->getHtml('Save', '0', '0'); ?>">
                                <?php endif; ?>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>

        <?php if (!$isNew) : ?>
        <input type="radio" id="c-tab-2" name="tabular-2"<?= $this->request->uri->fragment === 'c-tab-2' ? ' checked' : ''; ?>>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <section class="portlet">
                        <div class="portlet-head"><?= $this->getHtml('RiskStatus'); ?></div>
                        <div class="portlet-body">
                            <form id="fRisk"  method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/api}controlling/riskmanagement?{?}&csrf={$CSRF}'); ?>">
                                <table class="layout wf-100">
                                    <tbody>
                                    <tr><td><label for="iRiskConsequence"><?= $this->getHtml('RiskConsequence'); ?></label>
                                    <tr><td><select id="iRiskConsequence" name="riskconsequence">

                                            </select>
                                    <tr><td><label for="iRiskLikelihood"><?= $this->getHtml('RiskLikelihood'); ?></label>
                                    <tr><td><select id="iRiskLikelihood" name="risklikelihood">

                                            </select>
                                    <tr><td><label for="iRiskConsequence"><?= $this->getHtml('RiskConsequence'); ?></label>
                                    <tr><td><select id="iRiskConsequence" name="riskconsequence">

                                            </select>
                                    <tr><td><label for="iRiskLikelihood"><?= $this->getHtml('RiskLikelihood'); ?></label>
                                    <tr><td><select id="iRiskLikelihood" name="risklikelihood">

                                            </select>
                                    <tr><td><label for="iRiskStatusDescription"><?= $this->getHtml('Description'); ?></label>
                                    <tr><td><textarea id="iRiskStatusDescription" name="riskstatusdescription"></textarea>
                                    <tr><td><input type="submit" value="<?= $this->getHtml('Create', '0', '0'); ?>" name="">
                                </table>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <input type="radio" id="c-tab-3" name="tabular-2"<?= $this->request->uri->fragment === 'c-tab-3' ? ' checked' : ''; ?>>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <section class="portlet">
                        <div class="portlet-head"><?= $this->getHtml('RiskObjects'); ?></div>
                        <div class="portlet-body">
                            <form id="fRisk"  method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/api}controlling/riskmanagement?{?}&csrf={$CSRF}'); ?>">
                                <table class="layout wf-100">
                                    <tbody>
                                    <tr><td><label for="iRiskObjectName"><?= $this->getHtml('Name'); ?></label>
                                    <tr><td><input type="text" id="iRiskObjectName" name="riskobjectname">
                                    <tr><td><label for="iRiskObjectDescription"><?= $this->getHtml('Description'); ?></label>
                                    <tr><td><textarea id="iRiskObjectDescription" name="riskobjectdescription"></textarea>
                                    <tr><td><input type="submit" value="<?= $this->getHtml('Create', '0', '0'); ?>" name="">
                                </table>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <input type="radio" id="c-tab-4" name="tabular-2"<?= $this->request->uri->fragment === 'c-tab-4' ? ' checked' : ''; ?>>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <section class="portlet">
                        <div class="portlet-head"><?= $this->getHtml('RiskObjectStatus'); ?></div>
                        <div class="portlet-body">
                            <form id="fRisk"  method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/api}controlling/riskmanagement?{?}&csrf={$CSRF}'); ?>">
                                <table class="layout wf-100">
                                    <tbody>
                                    <tr><td><label for="iRiskObjectNameValue"><?= $this->getHtml('RiskObject'); ?></label>
                                    <tr><td><select id="iRiskObjectNameValue" name="riskobjectnamevalue">

                                            </select>
                                    <tr><td><label for="iRiskObjecValue"><?= $this->getHtml('Value'); ?></label>
                                    <tr><td><input type="text" id="iRiskObjecValue" name="riskobjectvalue">
                                    <tr><td><label for="iRiskObjecValueDescription"><?= $this->getHtml('Description'); ?></label>
                                    <tr><td><textarea id="iRiskObjecValueDescription" name="riskobjectvaluedescription"></textarea>
                                    <tr><td><input type="submit" value="<?= $this->getHtml('Create', '0', '0'); ?>" name="">
                                </table>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <input type="radio" id="c-tab-5" name="tabular-2"<?= $this->request->uri->fragment === 'c-tab-5' ? ' checked' : ''; ?>>
        <div class="tab">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <section class="portlet">
                        <div class="portlet-head"><?= $this->getHtml('Solution'); ?></div>
                        <div class="portlet-body">
                            <form id="fRisk"  method="POST" action="<?= \phpOMS\Uri\UriFactory::build('{/api}controlling/riskmanagement?{?}&csrf={$CSRF}'); ?>">
                                <table class="layout wf-100">
                                    <tbody>
                                    <tr><td><label for="iSolutionName"><?= $this->getHtml('Name'); ?></label>
                                    <tr><td><input type="text" id="iSolutionName" name="solutionname">
                                    <tr><td><label for="iSolutioType"><?= $this->getHtml('Type'); ?></label>
                                    <tr><td><select id="iSolutioType" name="solutiontype">
                                                <option>Preventing
                                                <option>Disclosing
                                            </select>
                                    <tr><td><label for="iSolutioFrequency"><?= $this->getHtml('Frequency'); ?></label>
                                    <tr><td><select id="iSolutioFrequency" name="solutionfrequency">
                                                <option>Permanently
                                                <option>Daily
                                                <option>Weekly
                                                <option>Monthly
                                                <option>Quarterly
                                                <option>Semiannual
                                                <option>Annual
                                            </select>
                                    <tr><td><label for="iSolutioAssessment"><?= $this->getHtml('Assessment'); ?></label>
                                    <tr><td><select id="iSolutioAssessment" name="solutionassessment">
                                                <option>Manual
                                                <option>IT-dependent
                                                <option>IT
                                            </select>
                                    <tr><td><label for="iSolutionDescription"><?= $this->getHtml('Description'); ?></label>
                                    <tr><td><textarea id="iSolutionDescription" name="solutionDescription"></textarea>
                                    <tr><td><input type="submit" value="<?= $this->getHtml('Create', '0', '0'); ?>" name="">
                                </table>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>