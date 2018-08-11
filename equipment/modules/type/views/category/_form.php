<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\Button;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];
?>
<div class="category-form">
    <?php $form = ActiveForm::begin([
        'options'=>[
            'enctype'=>'multipart/form-data',
            'class' => 'sliding-form'
        ]
    ]); ?>
    <?php Panel::begin([
        'title' => 'اطلاعات دسته'
    ]) ?>
    <div class="row">
        <div class="col-md-8">
            <?php Panel::begin() ?>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'code')->textInput(
                        ['style' => 'direction:ltr']
                    )->hint('۳ کاراکتر بزرگ لاتین به فرمت AAA') ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'title')->textInput() ?>
                </div>
            </div>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-4">
            <?php Panel::begin() ?>
                <?=
                    Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        [
                            'class' => 'btn btn-lg btn-success'
                        ]
                    )
                ?>
                <?= Button::widget([
                        'label' => 'انصراف',
                        'options' => ['class' => 'btn-lg close-sliding-form-button'],
                        'type' => 'warning',
                        'icon' => 'undo',
                        'url' => $backLink,
                    ])
                ?>
            <?php Panel::end() ?>
        </div>
    </div>
    <?php Panel::end() ?>
    <?php ActiveForm::end(); ?>
</div>
