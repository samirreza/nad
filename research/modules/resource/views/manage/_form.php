<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use core\widgets\editor\Editor;
use extensions\file\widgets\singleupload\SingleFileUpload;
use nad\research\modules\resource\models\Resource;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;

?>


<div class="row">
    <div class="col-md-12">
        <?php Panel::begin([
            'title' => 'اطلاعات منبع',
            'showCloseButton' => true
        ]) ?>
            <div class="resource-form">
                <?php $form = ActiveForm::begin([
                    'enableClientValidation' => true,
                    'options' => [
                        'class' => 'sliding-form'
                    ]
                ]) ?>
                    <div class="col-md-6">
                    <?= $form->field($model, 'title')->textInput() ?>
                    <?= $form->field($model, 'type')->dropDownList(
                        Resource::getTypeLabels()
                    ) ?>
                    <div class="input-medium">
                        <?= Html::label('فایل') ?>
                        <?= SingleFileUpload::widget([
                            'model' => $model,
                            'group' => 'resource'
                        ]) ?>
                    </div>
                    <?= $form->field($model, 'publishYear')->textInput([
                        'class' => 'form-control input-medium'
                    ]) ?>
                    <?= $form->field($model, 'author')->textInput() ?>
                    <?= $form->field($model, 'publisher')->textInput() ?>
                    </div>
                    <div class="col-md-6">
                    <?= $form->field($model, 'description')->widget(
                        Editor::class,
                        ['preset' => 'advanced']
                    ) ?>
                    <?= Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        [
                            'class' => 'btn btn-lg btn-success'
                        ]
                    ) ?>
                    <?= Button::widget([
                        'label' => 'انصراف',
                        'type' => 'warning',
                        'icon' => 'undo',
                        'options' => [
                            'class' => 'btn-lg close-sliding-form-button'
                        ]
                    ]) ?>
                    </div>
                <?php ActiveForm::end() ?>
            </div>
        <?php Panel::end() ?>
    </div>
</div>
