<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use nad\common\helpers\Lookup;
use core\widgets\editor\Editor;
use theme\widgets\ActionButtons;
use core\widgets\select2\Select2;
use nad\office\modules\expert\models\Expert;
use extensions\tag\widgets\selectTag\SelectTag;
use theme\widgets\jalalidatepicker\JalaliDatePicker;
use extensions\file\widgets\singleupload\SingleFileUpload;
use nad\common\modules\investigation\subject\models\SubjectCommon;
use nad\common\modules\investigation\reference\models\ReferenceUses;
use nad\common\modules\investigation\reference\widgets\selectReference\SelectReference;


$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];
$className = get_class($model);
$subjectFiles = $model->getFiles('subjectFile');
$reportFiles = $model->getFiles('reportFile');
$reportFiles2 = $model->getFiles('reportFile2');
?>

<h2 class="nad-page-title"><?= $this->title ?></h2>

<div class="subject-form">
    <?php Panel::begin(['title' => ($model->isReport()? 'مشخصات گزارش' : 'مشخصات موضوع')]) ?>
        <?php $form = ActiveForm::begin(
            ['options' => ['enctype' => 'multipart/form-data']]
        ) ?>
            <div class="row">
                <div class="col-md-8">
                    <?= $form->field($model, 'title')->textInput([
                        'maxlength' => 255,
                        'class' => 'form-control input-large'
                    ]) ?>
                    <?= $form->field($model, 'englishTitle')->textInput([
                        'maxlength' => 255,
                        'class' => 'form-control input-large'
                    ]) ?>
                    <?= $form->field($model, 'createdAt')->widget(
                        JalaliDatePicker::class,
                        [
                            'options' => [
                                'class' => 'form-control input-small',
                                'autocomplete' => 'off'
                            ]
                        ]
                    ) ?>
                    <?php if(!$model->isReport()): ?>
                        <div class="row">
                            <div class="col-md-4">
                                <?= $form->field($model, 'seoCode')->dropDownList(
                                    Lookup::extras(SubjectCommon::LOOKUP_SEO_CODE, true),
                                    [
                                        'prompt'=>'انتخاب کنید'
                                    ]
                                )->label('شناسه موضوع')
                                ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'unitCode')->textInput([
                                    'maxlength' => 255,
                                    'class' => 'form-control input-large',
                                    'dir' => 'ltr'
                                ])->label('کد واحد') ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                    <?php if($model->isReport()): ?>
                        <div class="col-md-8">
                            <?php
                            if(isset($reportFiles) && !empty($reportFiles)){
                                Panel::begin();
                            ?>
                                    <label>فایل گزارش</label>
                                    <?= SingleFileUpload::widget([
                                        'model' => $model,
                                        'group' => 'reportFile',
                                    ]) ?>
                            <?php
                                Panel::end();
                            }
                            ?>
                            <?php Panel::begin() ?>
                                <label>فایل گزارش</label>
                                <?= SingleFileUpload::widget([
                                    'model' => new $className,
                                    'group' => 'reportFile',
                                ]) ?>
                            <?php Panel::end() ?>
                        </div>
                        <div class="col-md-8">
                            <?php
                            if(isset($reportFiles2) && !empty($reportFiles2)){
                                Panel::begin();
                            ?>
                                    <label>مدارک</label>
                                    <?= SingleFileUpload::widget([
                                        'model' => $model,
                                        'group' => 'reportFile2',
                                    ]) ?>
                            <?php
                                Panel::end();
                            }
                            ?>
                            <?php Panel::begin() ?>
                                <label>مدارک</label>
                                <?= SingleFileUpload::widget([
                                    'model' => new $className,
                                    'group' => 'reportFile2',
                                ]) ?>
                            <?php Panel::end() ?>
                        </div>
                    <?php endif; ?>
                        <div class="col-md-8">
                            <?php
                            if(isset($subjectFiles) && !empty($subjectFiles)){
                                Panel::begin();
                            ?>
                                    <label>مستندات موضوع</label>
                                    <?= SingleFileUpload::widget([
                                        'model' => $model,
                                        'group' => 'subjectFile',
                                    ]) ?>
                            <?php
                                Panel::end();
                            }
                            ?>
                            <?php Panel::begin() ?>
                                <label>مستندات موضوع</label>
                                <?= SingleFileUpload::widget([
                                    'model' => new $className,
                                    'group' => 'subjectFile',
                                ]) ?>
                            <?php Panel::end() ?>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-sm-12">
                        <?= Html::submitButton('ذخیره', [
                            'class' => 'btn btn-xs btn-warning action-button'
                        ]) ?>
                        <?= Button::widget([
                            'label' => 'انصراف',
                            'type' => 'warning',
                            'icon' => false,
                            'url' => $backLink
                        ]) ?>
                    </div>
                    <?php if($model->isReport()): ?>
                        <br><br>
                        <?= $form->field($model, 'partners')->widget(
                            Select2::class,
                            [
                                'data' => ArrayHelper::map(
                                    expert::getNotDeletedUsers()->all(),
                                    'id',
                                    'user.fullname'
                                ),
                                'options' => [
                                    'multiple' => true,
                                    'placeholder' => 'همکاران را انتخاب کنید ...',
                                    'value' => $model->getPartnersAsArray()
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ]
                            ]
                        ) ?>
                        <?= $form->field($model, 'references')->widget(
                            SelectReference::class,
                            [
                                'consumer' => $referenceConsumerCode,
                                'code' => ReferenceUses::CODE_OTHER_REPORT
                            ]
                        ) ?>
                        <?= $form->field($model, 'tags')->widget(SelectTag::class) ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php if($model->isReport()): ?>
                        <?= $form->field($model, 'text')->hiddenInput()->label(false) ?>
                        <?= $form->field($model, 'unitCode')->hiddenInput()->label(false) ?>
                        <?= $form->field($model, 'creatorExpertCode')->hiddenInput()->label(false) ?>
                        <?= $form->field($model, 'seoCode')->hiddenInput()->label(false) ?>
                        <?= $form->field($model, 'text2')->widget(
                            Editor::class,
                            ['preset' => 'advanced']
                        ) ?>
                    <?php else: ?>
                        <?= $form->field($model, 'text')->widget(
                            Editor::class,
                            ['preset' => 'advanced']
                        ) ?>
                        <?php
                        $model->text2 = '-';
                        echo  $form->field($model, 'text2')->hiddenInput()->label(false);
                        ?>
                    <?php endif; ?>
                    <?= $form->field($model, 'description')->widget(
                        Editor::class,
                        ['preset' => 'advanced']
                    ) ?>
                </div>
            </div>
        <?php ActiveForm::end() ?>
    <?php Panel::end() ?>
</div>
