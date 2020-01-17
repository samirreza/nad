<?php

use yii\web\View;
use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use nad\office\modules\expert\models\Expert;
use theme\widgets\jalalidatepicker\JalaliDatePicker;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;
?>

<?php
$checkboxId = Html::getInputId($model, 'isMissionNeeded');
$this->registerJs(
    "
    if($('#{$checkboxId}').is(':checked')){
        $('#missionDetailsContainer input').prop('disabled', false);
        $('#missionDetailsContainer input').prop('readonly', false);
    }else{
        $('#missionDetailsContainer input').prop('disabled', true);
        $('#missionDetailsContainer input').prop('readonly', true);
    }

    $('#{$checkboxId}').on('click', function(event) {
        let isChecked = $(this).prop('checked');
        $('#missionDetailsContainer input').each(function(){
            $(this).val('');
            $(this).prop('disabled', !isChecked);
            $(this).prop('readonly', !isChecked);
        });
    });
    ",
    View::POS_READY,
    'mission-checkbox-handler'
);
?>

<div class="row">
    <div class="col-md-8">
        <?php Panel::begin([
            'title' => 'تعیین کارشناس',
            'showCloseButton' => true
        ]) ?>
            <div class="set-expert-form">
                <?php $form = ActiveForm::begin([
                    'options' => [
                        'class' => 'sliding-form'
                    ]
                ]) ?>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'expertId')->widget(
                            Select2::class,
                            [
                                'data' => ArrayHelper::map(
                                    Expert::getExpertsByPermission(
                                        $permission
                                    ),
                                    'id',
                                    'user.fullName'
                                ),
                                'options' => [
                                    'placeholder' => 'کارشناس را انتخاب کنید ...'
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ]
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <?= $form->field($model, 'isMissionNeeded')->checkbox()?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'missionObjective')->textArea()?>
                    </div>
                    <div class="col-md-6" id="missionDetailsContainer">
                        <div class="row">
                            <div class="col-md-12">
                                <?= $form->field($model, 'missionPlace')->textInput([
                                    'disabled' => 'disabled',
                                    'readonly' => 'readonly'
                                ])?>
                            </div>
                            <div class="col-md-12">
                                <?= $form->field($model, 'missionDate')->widget(
                                    JalaliDatePicker::class,
                                    [
                                        'options' => [
                                            'class' => 'form-control input-medium',
                                            'autocomplete' => 'off',
                                            'disabled' => '',
                                            'readonly' => ''
                                        ]
                                    ]
                                ) ?>
                            </div>
                        </div>
                    </div>
                </div>
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
