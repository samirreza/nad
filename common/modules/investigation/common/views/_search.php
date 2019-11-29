<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="source-search">
    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'action' => [$route],
        'method' => 'get',
        'class' => 'form-horizontal',
        'fieldConfig' => [
            'template' => '<div class="col-md-offset-2 col-md-3">{label}</div><div class="col-md-7">{input}{error}</div>',
        ]
    ]); ?>

    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'tag')->textInput(
            [
                'placeholder' => 'کلمه اول - کلمه دوم - ...'
            ])->label('کلمات کلیدی', ['class' => 'control-label pull-left']) ?>
        </div>
        <div class="col-md-2">
            <?= Html::submitButton('جستجو', ['class' => 'btn btn-success']) ?>
        </div>
    </div>



    <?php ActiveForm::end(); ?>
</div>