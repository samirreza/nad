<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use yii\bootstrap\ActiveForm;
use extensions\file\widgets\singleupload\SingleFileUpload;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;

?>

<div class="row">
    <div class="col-md-6">
        <?php Panel::begin([
            'title' => ($file->isNewRecord) ? 'افزودن فایل جدید' : 'ویرایش فایل',
            'showCloseButton' => true
        ]) ?>
            <div class="documentation-file-form">
                <?php $form = ActiveForm::begin([
                    'enableClientValidation' => true,
                    'options' => [
                        'enctype' => 'multipart/form-data',
                        'class' => 'sliding-form'
                    ]
                ]) ?>
                        <?= Html::activeHiddenInput($file, 'documentationId') ?>
                        <?= $form->field($file, 'title')->textInput(
                            ['maxlength' => 255, 'class' => 'form-control input-xlarge']
                        ) ?>
                        <?= $form->field($file, 'description')->textarea(
                            ['rows' => 6, 'class' => 'form-control input-xlarge']
                        ) ?>
                        <?= SingleFileUpload::widget([
                            'model' => $file,
                            'group' => 'file',
                            'folderName' => 'documentation',
                            'label' => ''
                        ]) ?>
                        <?= Html::submitButton(
                            '<i class="fa fa-save"></i> ذخیره',
                            [
                                'class' => 'btn btn-lg btn-success pull-left'
                            ]
                        ) ?>
                <?php ActiveForm::end() ?>
            </div>
        <?php Panel::end() ?>
    </div>
</div>
