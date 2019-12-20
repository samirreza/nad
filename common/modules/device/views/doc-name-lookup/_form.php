<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use core\widgets\select2\Select2;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;

?>

<div class="DocNameLookup-form">
    <?php $form = ActiveForm::begin(['options' => ['class' => 'sliding-form']]) ?>
        <?php Panel::begin([
            'title' => 'تعریف نام مدرک',
            'showCloseButton' => true
        ]) ?>
            <div class="row">
                <div class="col-md-9">
                    <?php Panel::begin() ?>
                        <div class="row">
                            <div class="col-md-4">
                                <?= $form->field($model, 'name')->textInput() ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'type')->widget(
                                    Select2::class,
                                    [
                                        'data' => $model->getTypes()
                                    ]
                                ) ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'extra')->textInput([
                                    'style' => 'direction:ltr'
                                ])->hint('در صورتی که در شناسه مدرک، از کد لاتین نام استفاده می شود فیلد فوق را پر کنید.') ?>
                            </div>
                        </div>
                    <?php Panel::end() ?>
                </div>
                <div class="col-md-3">
                    <?php Panel::begin() ?>
                        <?= Html::submitButton('<i class="fa fa-save"></i> ذخیره', [
                            'class' => 'btn btn-xs btn-warning'
                        ]) ?>
                        <?= Button::widget([
                            'label' => 'انصراف',
                            'options' => ['class' => 'btn-lg close-sliding-form-button'],
                            'type' => 'warning',
                            'icon' => 'undo'
                        ]) ?>
                    <?php Panel::end() ?>
                </div>
            </div>
        <?php Panel::end() ?>
    <?php ActiveForm::end() ?>
</div>
