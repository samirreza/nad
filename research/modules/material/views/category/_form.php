<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use core\widgets\select2\Select2;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;
?>
<div class="category-form">
    <?php $form = ActiveForm::begin([
        'options'=>['class' => 'sliding-form']
    ]); ?>
    <?php Panel::begin([
        'title' => 'اطلاعات رده',
        'showCloseButton' => true
    ]) ?>
    <div class="row">
        <div class="col-md-9">
            <?php Panel::begin() ?>
            <div class="row">
                <div class="col-md-4">
                    <?=
                        $form->field($model, 'parentId')
                            ->widget(Select2::class, [
                                'data' => $model->getParentsForSelect2()
                            ]);
                    ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'code')->textInput(
                        ['style' => 'direction:ltr', 'maxlength' => 3]
                    )->hint('۲ یا ۳ کاراکتر بزرگ لاتین به فرمت AAA') ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'title')->textInput() ?>
                </div>
            </div>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-3">
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
                        'icon' => 'undo'
                    ])
                ?>
            <?php Panel::end() ?>
        </div>
    </div>
    <?php Panel::end() ?>
    <?php ActiveForm::end(); ?>
</div>
