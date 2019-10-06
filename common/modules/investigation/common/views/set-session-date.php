<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use theme\widgets\dateTimePicker\DateTimePicker;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;

?>


<div class="row">
    <div class="col-md-6">
        <?php Panel::begin([
            'title' => 'تعیین زمان جلسه توجیهی',
            'showCloseButton' => true
        ]) ?>
            <div class="session-date-form">
                <?php $form = ActiveForm::begin([
                    'enableClientValidation' => true,
                    'options' => [
                        'class' => 'sliding-form'
                    ]
                ]) ?>
                    <?= $form->field($model, 'sessionDate')->widget(
                        DateTimePicker::class,
                        [
                            'dateAttribute' => 'sessionDate',
                            'hourAttribute' => 'sessionHourAttribute',
                            'minuteAttribute' => 'sessionMinuteAttribute',
                            'options' => [
                                'class' => 'form-control input-large'
                            ]
                        ]
                    ) ?>
                    <br>
                    <?= Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        [
                            'class' => 'btn btn-xs btn-warning'
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
