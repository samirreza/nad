<?php

use yii\web\View;
use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use nad\common\helpers\Lookup;
use core\widgets\select2\Select2;
use nad\office\modules\expert\models\Expert;
use theme\widgets\jalalidatepicker\JalaliDatePicker;
use nad\common\modules\investigation\subject\models\SubjectCommon;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;
?>

<?php
$checkboxId = Html::getInputId($model, 'isMissionNeeded');
$this->registerJs(
    "
    if($('#{$checkboxId}').is(':checked')){
        $('#missionDetailsContainer input').prop('disabled', false);
        $('#missionDetailsContainer input').prop('readonly', false);
        $('#missionDetailsContainer select').prop('disabled', false);
    }else{
        $('#missionDetailsContainer input').prop('disabled', true);
        $('#missionDetailsContainer input').prop('readonly', true);
        $('#missionDetailsContainer select').prop('disabled', true);
    }

    $('#{$checkboxId}').on('click', function(event) {
        let isChecked = $(this).prop('checked');
        $('#missionDetailsContainer input, #missionDetailsContainer select').each(function(){
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
                        <?= Button::widget([
                            'label' => 'انصراف',
                            'options' => [
                                'class' => 'btn-lg close-sliding-form-button pull-left'
                            ],
                            'type' => 'warning',
                            'icon' => 'undo'
                        ]) ?>
                        <?= Html::submitButton(
                            '<i class="fa fa-save"></i> ذخیره',
                            [
                                'class' => 'btn btn-xs btn-warning pull-left'
                            ]
                        ) ?>
                        <br/>
                        <br/>
                        <?= $form->field($model, 'isMissionNeeded')->checkbox()?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <?= $form->field($model, 'missionObjective')->textArea()?>
                        </div>
                        <div class="row">
                            <?= $form->field($model, 'reportExpertCode')->textInput()?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row" id="missionDetailsContainer">
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
                        <div class="row">
                            <div class="col-md-12">
                                <?= $form->field($model, 'reportDeadlineDate')->widget(
                                    JalaliDatePicker::class,
                                    [
                                        'options' => [
                                            'class' => 'form-control input-medium',
                                            'autocomplete' => 'off'
                                        ]
                                    ]
                                ) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        <?php Panel::end() ?>
    </div>
</div>
