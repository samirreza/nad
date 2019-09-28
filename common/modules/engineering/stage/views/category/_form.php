<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use core\widgets\select2\Select2;
use theme\widgets\Panel;
use theme\widgets\Button;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;
?>
<div class="category-form">
    <?php $form = ActiveForm::begin([
        'options'=>['class' => 'sliding-form']
    ]); ?>
    <?php Panel::begin([
        'title' => 'مرحله جدید',
        'showCloseButton' => true
    ]) ?>
    <?php Panel::begin() ?>
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'title')->textInput()->label('عنوان مرحله جدید') ?>
                </div>
                <div class="col-md-3">
                    <?=
                    $form->field($model, 'code')->textInput(
                        ['style' => 'direction:ltr', 'maxlength' => 3]
                    )->label('شناسه مرحله')->hint('1 تا 3 کاراکتر بزرگ لاتین به فرمت AAA')
                    ?>
                </div>
                <div class="col-md-4">
                <?=
                        $form->field($model, 'parentId')
                            ->widget(Select2::class, [
                                'data' => $model->getParentsForSelect2('درج به عنوان مرحله 1'),
                                'options' => [
                                    'placeholder' => 'sd'
                                ]
                            ])->label('انتخاب مرحله پدر');
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
        <br>
            <div class="col-ssm-12">
                <?=
                    Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        [
                            'class' => 'btn btn-xs btn-warning action-button'
                        ]
                    )
                ?>
                <?= Button::widget([
                        'label' => 'انصراف',
                        'options' => ['class' => 'close-sliding-form-button'],
                        'type' => 'warning',
                        'icon' => 'undo'
                    ])
                ?>
            </div>
        </div>
    </div>
    <?php Panel::end() ?>
    <?php Panel::end() ?>
    <?php ActiveForm::end(); ?>
</div>
