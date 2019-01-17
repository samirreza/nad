<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use core\widgets\select2\Select2;
use nad\office\modules\expert\models\Expert;
use modules\user\common\widgets\ShowPassword;
use extensions\file\widgets\singleupload\SingleFileUpload;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;

?>


<div class="row">
    <div class="col-md-12">
        <?php Panel::begin([
            'title' => 'درج کارشناس',
            'showCloseButton' => true
        ]) ?>
            <div class="expert-form">
                <?php $form = ActiveForm::begin([
                    'enableClientValidation' => true,
                    'options' => [
                        'class' => 'sliding-form'
                    ]
                ]) ?>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($expertForm, 'name')->textInput(
                                    ['class' => 'form-control input-xlarge']
                                ) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($expertForm, 'surname')->textInput(
                                    ['class' => 'form-control input-xlarge']
                                ) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($expertForm->user, 'email')->textInput([
                                    'class' => 'form-control input-xlarge',
                                    'style' => 'direction:ltr'
                                ]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($expertForm->user, 'phone')->textInput([
                                    'class' => 'form-control input-xlarge',
                                    'style' => 'direction:ltr'
                                ]) ?>
                            </div>
                        </div>
                        <?php if ($expertForm->user->isNewRecord) : ?>
                            <?= $form->field($expertForm->user, 'password')->widget(
                                ShowPassword::class,
                                [
                                    'options' => ['class' => 'form-control']
                                ]
                            )?>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($expertForm->expert, 'departmentId')->widget(
                            Select2::class,
                            [
                                'data' => Expert::getDepartmentLabels()
                            ]
                        ) ?>
                        <div class="input-xlarge">
                            <?= Html::label('مدارک') ?>
                            <?= SingleFileUpload::widget([
                                'model' => $expertForm->expert,
                                'group' => 'evidence'
                            ]) ?>
                        </div>
                    <div>
                    <br>
                    <?= Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        [
                            'class' => 'btn btn-lg btn-success'
                        ]
                    ) ?>
                    <?= Button::widget([
                        'label' => 'انصراف',
                        'options' => [
                            'class' => 'btn-lg close-sliding-form-button'
                        ],
                        'type' => 'warning',
                        'icon' => 'undo'
                    ]) ?>
                <?php ActiveForm::end() ?>
            </div>
        <?php Panel::end() ?>
    </div>
</div>
