<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use nad\common\helpers\Lookup;
use core\widgets\select2\Select2;
use nad\common\modules\device\models\DevicePart;
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
            <?= $form->field($model, 'deviceId')->hiddenInput()->label(false); ?>
            <div class="row">
                <div class="col-md-6">
                <?= $form->field($model, 'title')->textInput(['maxlength' => 255,
                        'class' => 'form-control input-large']) ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'code')->textInput(['maxlength' => 3,
                        'class' => 'form-control input-large', 'dir' => 'ltr']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                <?= $form->field($model, 'group')->dropDownList(
                        Lookup::items(DevicePart::LOOKUP_GROUP_TYPE),
                        ['prompt'=>'انتخاب کنید']
                    ) ?>
                </div>
            </div>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-3">
            <?php Panel::begin() ?>
                <?=
                    Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        ['class' => 'btn btn-xs btn-warning']
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
