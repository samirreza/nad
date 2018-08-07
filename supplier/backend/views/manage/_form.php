<?php

use yii\helpers\Html;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\Button;
use yii\widgets\ActiveForm;
use modules\nad\supplier\backend\models\Supplier;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];
?>
<div class="supplier-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-8">
            <?php Panel::begin([
                'title' => 'اطلاعات تامین کننده'
            ]) ?>
            <?=
            $form->field($model, 'name')
                ->textInput(
                    [
                        'maxlength' => 255,
                        'class' => 'form-control input-large'
                    ]
                )
            ?>
            <?=
            $form->field($model, 'email')
                ->textInput(
                    [
                        'class' => 'form-control input-large'
                    ]
                )
            ?>
            <?=
            $form->field($model, 'website')
                ->textInput(
                    [
                        'class' => 'form-control input-large'
                    ]
                )
            ?>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-4">
            <?php Panel::begin([
                'title' => 'نوع تامین کننده و نحوه پرداخت'
            ]) ?>

            <?=
            $form->field($model, 'isForeign')
                ->dropDownList(
                    [
                        'داخلی',
                        'خارجی',
                    ],
                    [
                        'class' => 'form-control input-large',
                        'prompt' => 'انتخاب کنید...'
                    ]
                )
            ?>

            <?=
            $form->field($model, 'kind')
                ->dropDownList(
                    Supplier::getKindsList(),
                    [
                        'class' => 'form-control input-large',
                        'prompt' => 'انتخاب کنید...'
                    ]
                )
            ?>

            <?=
            $form->field($model, 'paymentType')
                ->dropDownList(
                    [
                        'نقدی',
                        'شرایطی',
                        'هردو',
                    ],
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
    </div>
    <?php ActiveForm::end(); ?>
</div>




