<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;
$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];
?>
<div class="job-form">
    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
            'class' => 'sliding-form'
        ]
    ]); ?>
    <?php Panel::begin([
        'title' => 'اطلاعات سمت',
        'showCloseButton' => true
    ]) ?>
    <div class="row">
        <div class="col-md-8">
            <?php Panel::begin() ?>
            <?=
            $form->field($model, 'title')
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
                'title' => 'ذخیره اطلاعات'
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-save"></i> ذخیره', [
                    'class' => 'btn btn-lg btn-success'
                ]) ?>
                <?= Button::widget([
                    'label' => 'انصراف',
                    'options' => ['class' => 'btn-lg close-sliding-form-button'],
                    'type' => 'warning',
                    'icon' => 'undo',
                    'url' => $backLink,
                ])
                ?>
            </div>
            <?php Panel::end() ?>
        </div>
    </div>
    <?php Panel::end() ?>
    <?php ActiveForm::end(); ?>
</div>




