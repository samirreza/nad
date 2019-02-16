<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use core\widgets\editor\Editor;
use extensions\file\widgets\singleupload\SingleFileUpload;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;

?>

<div class="equipment-type-document-form">
    <?php Panel::begin([
        'title' => 'مدرک جدید',
        'showCloseButton' => true
    ]) ?>
        <?php $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
                'class' => 'sliding-form'
            ]
        ]) ?>
            <?= Html::activeHiddenInput(
                $model,
                'equipmentTypeId',
                ['id' => 'hidden-equipment-type-id']
            ) ?>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'title')->textInput([
                        'class' => 'form-control input-xlarge'
                    ]) ?>
                    <?= $form->field($model, 'uniqueCode')->textInput([
                        'class' => 'form-control input-xlarge'
                    ]) ?>
                    <?= $form->field($model, 'archivesAddress')->textInput([
                        'class' => 'form-control input-xlarge'
                    ]) ?>
                    <div class="input-xlarge">
                        <label>فایل مدرک</label>
                        <?= SingleFileUpload::widget([
                            'model' => $model,
                            'group' => 'file'
                        ]) ?>
                    </div>
                    <br>
                    <?= Html::submitButton('<i class="fa fa-save"></i> ذخیره', [
                        'class' => 'btn btn-lg btn-success'
                    ]) ?>
                    <?= Button::widget([
                        'label' => 'انصراف',
                        'options' => ['class' => 'btn-lg close-sliding-form-button'],
                        'type' => 'warning',
                        'icon' => 'undo',
                        'url' => ['index']
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'description')->widget(
                        Editor::class,
                        ['preset' => 'advanced']
                    ) ?>
                </div>
            </div>
        <?php ActiveForm::end() ?>
    <?php Panel::end() ?>
</div>

<?php $this->registerJs('
    $("#hidden-equipment-type-id").val($(".ajaxcreate").attr("data-equipment-type-id"));
');
