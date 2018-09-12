<?php

use core\widgets\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\Button;
use modules\nad\repairer\backend\models\WorkType;
use modules\nad\supplier\backend\models\Supplier;


$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];
?>
<div class="repairer-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-8">
            <?php Panel::begin([
                'title' => 'اطلاعات تعمیرکار'
            ]) ?>
            <div class="row">
                <div class="col-md-12">
                    <?=
                    $form->field($model, 'title')
                        ->textInput(
                            [
                                'maxlength' => 255,
                                'class' => 'form-control input-large'
                            ]
                        )
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?=
                    $form->field($model, 'fame')
                        ->textInput(
                            [
                                'maxlength' => 255,
                                'class' => 'form-control input-large'
                            ]
                        )
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?=
                    $form->field($model, 'phone')
                        ->textInput(
                            [
                                'class' => 'form-control input-large',
                                'style' => 'direction: ltr;'
                            ]
                        )
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?=
                    $form->field($model, 'email')
                        ->textInput(
                            [
                                'class' => 'form-control input-large',
                                'style' => 'direction: ltr;'
                            ]
                        )
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?=
                    $form->field($model, 'website')
                        ->textInput(
                            [
                                'class' => 'form-control input-large',
                                'style' => 'direction: ltr;'
                            ]
                        )
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?=
                    $form->field($model, 'mobile')
                        ->textInput(
                            [
                                'class' => 'form-control input-large',
                                'style' => 'direction: ltr;'
                            ]
                        )
                    ?>
                </div>
                <div class="col-md-6">
                    <?=
                    $form->field($model, 'fax')
                        ->textInput(
                            [
                                'class' => 'form-control input-large',
                                'style' => 'direction: ltr;'
                            ]
                        )
                    ?>
                </div>
            </div>
            <?php Panel::end() ?>
        </div>

        <div class="col-md-4">
            <?php Panel::begin([
                'title' => 'ذخیره اطلاعات'
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-save"></i> ذخیره', [
                    'class' => 'btn btn-lg btn-success'
                ]) ?>
                <?= Button::widget([
                    'label' => 'انصراف',
                    'options' => ['class' => 'btn-lg'],
                    'type' => 'warning',
                    'icon' => 'undo',
                    'url' => $backLink,
                ])
                ?>
            </div>
            <?php Panel::end() ?>
        </div>

        <div class="col-md-4">
            <?php Panel::begin([
                'title' => 'انتخاب حرفه تعمیرکار'
            ]) ?>
            <?= $form->field($model, 'works')->widget(
                Select2::class,
                [
                    'data' => ArrayHelper::map(
                        WorkType::find()->all(),
                        'title',
                        'title'
                    ),
                    'options' => [
                        'multiple' => true,
                        'value' => $model->getWorksAsArray()
                    ]
                ]
            )
            ?>
            <?php Panel::end() ?>
        </div>

        <div class="col-md-4">
            <?php Panel::begin([
                'title' => 'نوع تعمیرکار و نحوه پرداخت'
            ]) ?>
            <?=
            $form->field($model, 'isLegal')
                ->dropDownList(
                    [
                        'حقیقی',
                        'حقوقی',
                    ],
                    [
                        'class' => 'form-control input-large',
                        'prompt' => 'انتخاب کنید...'
                    ]
                )
            ?>
            <?=
            $form->field($model, 'paymentType')
                ->dropDownList(
                    Supplier::getPaymentTypeList(),
                    [
                        'class' => 'form-control input-large',
                        'prompt' => 'انتخاب کنید...'
                    ]
                )
            ?>
            <?php Panel::end() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <?php Panel::begin([
                'title' => 'آدرس و توضیحات'
            ]) ?>
            <?=
            $form->field($model, 'shopAddress')
                ->textarea(
                    [
                        'class' => 'form-control input-large',
                        'style' => 'width:475px;height:85px;resize: none;'
                    ]
                )
            ?>
            <?=
            $form->field($model, 'factoryAddress')
                ->textarea(
                    [
                        'class' => 'form-control input-large',
                        'style' => 'width:475px;height:85px;resize: none;'
                    ]
                )
            ?>
            <?=
            $form->field($model, 'description')
                ->textarea(
                    [
                        'class' => 'form-control input-large',
                        'style' => 'width:475px;height:85px;resize: none;'
                    ]
                )
            ?>
            <?=
            $form->field($model, 'satisfaction')
                ->textInput(
                    [
                        'maxlength' => 255,
                        'class' => 'form-control input-large'
                    ]
                )
            ?>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-4">
            <?php Panel::begin([
                'title' => 'تجهیزات و قطعات تعمیرکار'
            ]) ?>
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
            <?php Panel::end() ?>
        </div>
        <div class="col-md-4">
            <?php Panel::begin([
                'title' => 'وضعیت تعمیرکار'
            ]) ?>
            <?= $form->field($model, 'isActive')->checkbox(); ?>

            <?php Panel::end() ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>




