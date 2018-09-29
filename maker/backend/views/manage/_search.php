<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use core\widgets\select2\Select2;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\Button;

?>

<div class="maker-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-12">
            <?php Panel::begin([
                'title' => 'جستجوی سازنده بر اساس تجهیزات و قطعات'
            ]) ?>

            <div class="row">
                <div class="col-md-5">
                    <?= $form->field($model, 'equipments')->widget(
                        Select2::class,
                        [
                            'options' => [
                                'multiple' => true,
                                'placeholder' => 'انتخاب کنید ...',
                                'value' => $model->getEquipmentsAsArray()
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'minimumInputLength' => 2,
                                'ajax' => [
                                    'url' => Url::to(['/equipment/type/manage/ajax-find-equipments']),
                                    'dataType' => 'json',
                                    'delay' => 1000,
                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                ],
                                'templateResult' => new JsExpression('function(equipment) { return equipment.text; }'),
                            ],
                        ]
                    ) ?>
                </div>
                <div class="col-md-5">
                    <?= $form->field($model, 'parts')->widget(
                        Select2::class,
                        [
                            'options' => [
                                'multiple' => true,
                                'placeholder' => 'انتخاب کنید ...',
                                'value' => $model->getPartsAsArray()
                            ],
                            'pluginOptions' => [
                                'allowClear' => true,
                                'minimumInputLength' => 2,
                                'ajax' => [
                                    'url' => Url::to(['/equipment/type/details/part/ajax-find-parts']),
                                    'dataType' => 'json',
                                    'delay' => 1000,
                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                ],
                                'templateResult' => new JsExpression('function(part) { return part.text; }'),
                            ],
                        ]
                    ) ?>
                </div>
                <div class="col-md-2">
                    <div class="form-group" style="margin-top: 20%;">
                        <?= Html::submitButton(
                            '<i class="fa fa-search"></i>',
                            ['class' => 'btn btn-success']
                        ) ?>
                        <?= Button::widget([
                            'label' => '',
                            'type' => 'warning',
                            'icon' => 'undo',
                            'url' => ['index'],
                        ])
                        ?>
                    </div>
                </div>
            </div>
            <?php Panel::end() ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
