<?php

use yii\helpers\Html;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\Button;
use yii\widgets\ActiveForm;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];
?>
<div class="job-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-8">
            <?php Panel::begin([
                'title' => 'اطلاعات سمت'
            ]) ?>
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




