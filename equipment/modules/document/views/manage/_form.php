<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use extensions\file\widgets\singleupload\SingleFileUpload;
use modules\nad\equipment\modules\document\models\DocumentType;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;

?>

<div class="equipment-document-form">
    <?php Panel::begin([
        'title' => 'بارگذاری سند',
        'showCloseButton' => true
    ]) ?>
        <?php $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
                'class' => 'sliding-form'
            ]
        ]) ?>
            <?= Html::activeHiddenInput($model, 'equipmentTypeId', ['id' => 'hidden-typeId']) ?>
            <div class="row">
                <div class="col-md-8">
                    <?= $form->field($model, 'documentTypeId')->widget(
                        Select2::class,
                        [
                            'data' => ArrayHelper::map(
                                DocumentType::find()->all(),
                                'id',
                                'title'
                            ),
                            'options' => [
                                'placeholder' => 'انتخاب کنید ...',
                                'class' => 'form-control input-large'
                            ]
                        ]
                    ) ?>
                    <br>
                    <div class="input-large">
                        <label>فایل سند</label>
                        <?= SingleFileUpload::widget([
                            'model' => $model,
                            'group' => 'file',
                        ]) ?>
                    </div>
                </div>
                <div class="col-md-4">
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
            </div>
        <?php ActiveForm::end() ?>
    <?php Panel::end() ?>
</div>

<?php $this->registerJs('
    $("#hidden-typeId").val($(".ajaxcreate").attr("data-typeId"));
');
