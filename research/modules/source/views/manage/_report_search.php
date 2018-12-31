<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use nad\office\modules\expert\models\Expert;
use extensions\tag\widgets\selectTag\SelectTag;
use nad\research\modules\proposal\models\Proposal;
use nad\research\modules\source\models\SourceReason;
use theme\widgets\jalalidatepicker\JalaliDatePicker;

?>

<div class="source-report-form">
    <?php $form = ActiveForm::begin([
        'action' => ['report'],
        'method' => 'get'
    ]) ?>
        <?php Panel::begin(['showCollapseButton' => true, 'title' => 'جست و جو']) ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <?= $form->field($model, 'title')->textInput() ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'englishTitle')->textInput() ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'uniqueCode')->textInput() ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'createdBy')->widget(
                            Select2::class,
                            [
                                'data' => ArrayHelper::map(
                                    Expert::getDepartmentExperts(
                                        Expert::DEPARTMENT_RESEARCH
                                    ),
                                    'userId',
                                    'email'
                                ),
                                'options' => [
                                    'placeholder' => 'ایمیل کارشناس را انتخاب کنید'
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ]
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'mainReasonId')->widget(
                            Select2::class,
                            [
                                'data' => ArrayHelper::map(
                                    SourceReason::find()->all(),
                                    'id',
                                    'title'
                                ),
                                'options' => [
                                    'placeholder' => 'علت را انتخاب کنید'
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ]
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'tags')->widget(
                            SelectTag::class,
                            [
                                'pluginOptions' => [
                                    'tags' => false
                                ]
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'status')->dropDownList(
                            Proposal::getStatusLables(),
                            [
                                'prompt' => ''
                            ]
                        ) ?>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2" style="padding-top: 30px;">
                                <b><p>تاریخ پیشنهاد :</p></b>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'beginDate')
                                    ->widget(
                                        JalaliDatePicker::class,
                                        [
                                            'options' => [
                                                'autocomplete' => 'off'
                                            ]
                                        ]
                                    )
                                    ->label('از')
                                ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'endDate')
                                    ->widget(
                                        JalaliDatePicker::class,
                                        [
                                            'options' => [
                                                'autocomplete' => 'off'
                                            ]
                                        ]
                                    )
                                    ->label('تا')
                                ?>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-4">
                        <?= $form->field($model, 'reason')->textarea() ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'necessity')->textarea() ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <?= Html::submitButton(
                            '<i class="fa fa-search"></i>',
                            ['class' => 'btn btn-success']
                        ) ?>
                        <?= Button::widget([
                            'label' => '',
                            'type' => 'warning',
                            'icon' => 'undo',
                            'url' => ['report']
                        ])
                        ?>
                    </div>
                </div>
            </div>
        <?php Panel::end() ?>
    <?php ActiveForm::end() ?>
</div>
