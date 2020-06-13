<?php

use theme\widgets\Panel;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use core\widgets\select2\Select2;
use nad\rla\models\RowLevelAccess;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
?>

<br>
<?php Panel::begin([
            'title' => 'انتخاب داده گاه',
            'showCollapseButton' => true
        ]) ?>
<div class="rla-search">
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
        <div class="col-md-4">
            <div class="form-group">
                <label for="searchModel">داده گاه مورد نظر خود را انتخاب کنید</label>
                <?= Select2::widget([
                    'name' => 'searchModel',
                    'value' => $searchModel,
                    'data' => $itemTypes,
                    'options' => [
                        'placeholder' => 'انتخاب کنید ...'
                    ]
                ]);
                ?>

            </div>
        </div>
        <div class="col-md-2">
            <br>
            <?= Html::submitButton('نمایش داده گاه', ['class' => 'btn btn-success']) ?>
        </div>
    </div>



    <?php ActiveForm::end(); ?>
</div>
<?php Panel::end() ?>