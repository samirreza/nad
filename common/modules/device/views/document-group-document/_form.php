<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use theme\widgets\Panel;
use theme\widgets\Button;
use nad\common\helpers\Lookup;
use core\widgets\select2\Select2;
use extensions\file\widgets\singleupload\SingleFileUpload;
use nad\common\modules\device\models\DocumentGroup;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;
$className = get_class($model);
$uploadedFiles = $model->getFiles('file');
?>
<div class="form">
    <?php $form = ActiveForm::begin([
        'options'=>['class' => 'sliding-form']
    ]); ?>
    <?php Panel::begin([
        'title' => 'اطلاعات اصلی',
        'showCloseButton' => true
    ]) ?>
    <div class="row">
        <div class="col-md-9">
            <?php Panel::begin() ?>
            <?= Html::activeHiddenInput($model, 'groupId'); ?>
            <div class="row">
                <div class="col-md-8">
                    <?= $form->field($model, 'title')->textInput() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'documentType')->dropDownList(
                        Lookup::extras('nad.device.DocumentGroupDocument.Type', true),
                        ['prompt'=>'انتخاب کنید']
                    ) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'revisionNumber')->textInput(
                        [
                            'class' => 'form-control',
                            'dir' => 'ltr'
                        ]
                    ) ?>
                </div>
                <div class="col-md-4">
                    <?= $model->getAttributeLabel('uniqueCode'); ?>
                    <?=
                    Html::textInput(
                        null,
                        $model->getUniqueCode(),
                        [
                            'class' => 'form-control',
                            'dir' => 'ltr',
                            'disabled' => 'true'
                        ]
                    );
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-11">
                    <p class="help-block">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    پس از ذخیره فرم، شناسه مدرک با کد نوع مدرک و شمارنده انتخاب شده، بروز خواهد شد.
                    </p>
                </div>
            </div>
            <br/>

            <div class="row">
                <div class="col-md-9">
                <?= $form->field($model, 'producerName')->textInput([]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9">
                <?= $form->field($model, 'verifierName')->textInput([]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9">
                    <?= $form->field($model, 'description')->textarea([]) ?>
                </div>
            </div>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-3">
            <?php Panel::begin() ?>
                <?=
                    Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        ['class' => 'btn btn-xs btn-warning']
                    )
                ?>
                <?= Button::widget([
                        'label' => 'انصراف',
                        'options' => ['class' => 'btn-lg close-sliding-form-button'],
                        'type' => 'warning',
                        'icon' => 'undo'
                    ])
                ?>
            <?php Panel::end() ?>
            <?php Panel::begin() ?>
            <?php
            if(isset($uploadedFiles) && !empty($uploadedFiles)){
            ?>
                    <label>فایل مستندات</label>
                    <?= SingleFileUpload::widget([
                        'model' => $model,
                        'group' => 'file',
                    ]) ?>
            <?php
            }else{
                ?>
                <label>فایل مستندات</label>
                <?= SingleFileUpload::widget([
                    'model' => new $className,
                    'group' => 'file',
                ]) ?>
            <?php
            } Panel::end()
            ?>

            <?php Panel::begin() ?>
            <?php
            if(isset($uploadedFiles) && !empty($uploadedFiles)){
            ?>
                    <label>مستندات بازنگری</label>
                    <?= SingleFileUpload::widget([
                        'model' => $model,
                        'group' => 'fileRevised',
                    ]) ?>
            <?php
            }else{
                ?>
                <label>مستندات بازنگری</label>
                <?= SingleFileUpload::widget([
                    'model' => new $className,
                    'group' => 'fileRevised',
                ]) ?>
            <?php
            } Panel::end()
            ?>
        </div>
    </div>
    <?php Panel::end() ?>
    <?php ActiveForm::end(); ?>
</div>
