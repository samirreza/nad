<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model nad\common\modules\engineering\location\models\Location */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="location-search">
    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'action' => ['index'],
        'method' => 'get',
        'class' => 'form-horizontal',
        'fieldConfig' => [
            'template' => '<div class="col-md-offset-2 col-md-2">{label}</div><div class="col-md-8">{input}{error}</div>',
        ]
    ]); ?>

    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'titleOrCode')->label('عنوان/شناسه') ?>
        </div>
        <div class="col-md-2">
            <?= Html::submitButton('جستجو', ['class' => 'btn btn-success']) ?>
        </div>
    </div>



    <?php ActiveForm::end(); ?>
</div>