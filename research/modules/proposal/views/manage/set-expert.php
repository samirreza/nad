<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use nad\research\modules\expert\models\Expert;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;

?>


<div class="row">
    <div class="col-md-6">
        <?php Panel::begin([
            'title' => 'تعیین کارشناس',
            'showCloseButton' => true
        ]) ?>
            <div class="set-experts-form">
                <?php $form = ActiveForm::begin([
                    'enableClientValidation' => true,
                    'options' => [
                        'enctype' => 'multipart/form-data',
                        'class' => 'sliding-form'
                    ]
                ]) ?>
                    <?= $form->field($model, 'expertUserId')->widget(
                        Select2::class,
                        [
                            'data' => ArrayHelper::map(
                                Expert::find()->all(),
                                'userId',
                                'email'
                            ),
                            'options' => [
                                'placeholder' => 'ایمیل کارشناس را انتخاب کنید ...'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ]
                        ]
                    ) ?>
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