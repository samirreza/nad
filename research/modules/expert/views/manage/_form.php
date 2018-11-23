<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use modules\user\backend\models\User;

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
                        'enctype' => 'multipart/form-data',
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
                                'placeholder' => 'لطفا ایمیل کاربر مورد نظر را وارد کنید ...',
                                'multiple' => false
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
