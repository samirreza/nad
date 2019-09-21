<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model nad\common\modules\engineering\document\models\Document */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="document-search">
    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'action' => ['index', 'DocumentSearch[groupId]' => $groupId],
        'method' => 'get',
        'class' => 'form-horizontal',
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-md-12',                
            ],
            'template' => '<div class="col-md-offset-1 col-md-3">{label}</div><div class="col-md-8">{input}{error}</div>',
        ]
    ]); ?>

    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'title') ?>
        </div>
        <div class="col-md-2">
            <?= Html::submitButton('جستجو', ['class' => 'btn btn-success']) ?>        
        </div>
    </div>

    

    <?php ActiveForm::end(); ?>
</div>