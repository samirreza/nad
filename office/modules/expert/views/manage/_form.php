<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use modules\user\backend\models\User;
use nad\office\modules\expert\models\Expert;
use extensions\file\widgets\singleupload\SingleFileUpload;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;

?>


<div class="row">
    <div class="col-md-6">
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
                    <?= $form->field($model, 'userId')->widget(
                        Select2::class,
                        [
                            'data' => ArrayHelper::map(
                                User::find()->all(),
                                'id',
                                'email'
                            ),
                            'options' => [
                                'placeholder' => 'لطفا ایمیل کاربر مورد نظر را وارد کنید ...'
                            ]
                        ]
                    ) ?>
                    <?= $form->field($model, 'departmentId')->widget(
                        Select2::class,
                        [
                            'data' => Expert::getDepartmentLabels()
                        ]
                    ) ?>
                    <div class="input-medium">
                        <?= Html::label('مدارک') ?>
                        <?= SingleFileUpload::widget([
                            'model' => $model,
                            'group' => 'evidence'
                        ]) ?>
                    </div>
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
