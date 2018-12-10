<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use nad\research\modules\expert\models\Expert;
use nad\research\modules\source\models\Source;
use extensions\tag\widgets\selectTag\SelectTag;
use nad\research\modules\proposal\models\Proposal;
use nad\extensions\thing\widgets\selectThing\SelectMaterials;
use nad\extensions\thing\widgets\selectThing\SelectEquipments;
use nad\extensions\thing\widgets\selectThing\SelectEquipmentParts;

?>

<div class="proposal-search">
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
                        <?= $form->field($model, 'createdBy')->widget(
                            Select2::class,
                            [
                                'data' => ArrayHelper::map(
                                    Expert::find()->all(),
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
                        <?= $form->field($model, 'sourceId')->dropDownList(
                            ArrayHelper::map(
                                Source::find()->all(),
                                'id',
                                'title'
                            ),
                            [
                                'prompt' => ''
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'expertUserId')->widget(
                            Select2::class,
                            [
                                'data' => ArrayHelper::map(
                                    Expert::find()->all(),
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
                        <?= $form->field($model, 'materials')
                            ->widget(SelectMaterials::class)
                            ->label('مواد') ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'equipments')
                            ->widget(SelectEquipments::class)
                            ->label('تجهیزات') ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'equipmentParts')
                            ->widget(SelectEquipmentParts::class)
                            ->label('قطعات') ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'status')->dropDownList(
                            Proposal::getStatusLables(),
                            [
                                'prompt' => ''
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'necessity')->textarea() ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'mainPurpose')->textarea() ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'secondaryPurpose')->textarea() ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'proceedings')->textarea() ?>
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
                            'url' => ['report'],
                        ])
                        ?>
                    </div>
                </div>
            </div>
        <?php Panel::end() ?>
    <?php ActiveForm::end(); ?>
</div>
