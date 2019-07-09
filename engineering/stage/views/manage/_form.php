<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use theme\widgets\Panel;
use theme\widgets\Button;
use core\widgets\select2\Select2;
use nad\engineering\stage\models\Category;
use extensions\file\widgets\singleupload\SingleFileUpload;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;
?>
<div class="form">
    <?php $form = ActiveForm::begin([
        'options'=>['class' => 'sliding-form']
    ]); ?>
    <?php Panel::begin([
        'title' => 'اطلاعات اصلی',
        'showCloseButton' => true
    ]) ?>
    <div class="row">
        <div class="col-md-9">
            <?php Panel::begin() ?>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'title')->textInput() ?>
                </div>
                <div class="col-md-2">
                    <?= $form->field($model, 'code')->textInput(
                        ['style' => 'direction:ltr', 'maxlength' => 1]
                    )->hint('تنها یک کاراکتر لاتین') ?>
                </div>            
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?=
                    $form->field($model, 'categoryId')
                        ->widget(
                            Select2::class,
                            [
                                'data' => ArrayHelper::map(
                                    Category::find()->where(['depth' => 4])->all(),
                                    'id',
                                    'codedTitle'
                                )
                            ]
                        );
                    ?>
                </div>                
                <div class="col-md-4">
                    <?=
                    $form->field($model, 'parentId')
                        ->widget(
                            Select2::class,
                            [
                                'data' => $model->getAllStagesAsDropdown(),
                                'options' => ['placeholder' => 'انتخاب کنید...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]
                        );
                    ?>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-8">
                    <?= $form->field($model, 'description')->textarea([]) ?>
                </div>
            </div>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-3">
            <?php Panel::begin() ?>
                <?=
                    Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        ['class' => 'btn btn-lg btn-success']
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
            <?php Panel::begin() ?>
                <label>فایل مستندات</label>
                <?= SingleFileUpload::widget([
                    'model' => $model,
                    'group' => 'file',
                ]) ?>
            <?php Panel::end() ?>
        </div>
    </div>
    <?php Panel::end() ?>
    <?php ActiveForm::end(); ?>
</div>
