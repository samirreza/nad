<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use extensions\file\widgets\singleupload\SingleFileUpload;
use modules\nad\equipment\modules\document\models\DocumentType;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;
$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];
?>
    <div class="phonebook-form">

        <?php $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
                'class' => 'sliding-form'
            ]
        ]); ?>

        <?= Html::activeHiddenInput($model, 'typeId', ['id' => 'hidden-typeId']) ?>

        <?php Panel::begin([
            'title' => 'بارگذاری سند',
            'showCloseButton' => true
        ]) ?>
        <div class="row">
            <div class="col-md-8">
                <?php Panel::begin() ?>
                <?=
                $form->field($model, 'documentId')
                    ->dropDownList(
                        ArrayHelper::map(DocumentType::find()->all(), 'id', 'title'),
                        [
                            'class' => 'form-control input-large',
                            'prompt' => 'انتخاب کنید...'
                        ]
                    )
                ?>
                <br/>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12" style="margin-right: -3%;">
                    <label>فایل سند</label>
                    <?=
                    SingleFileUpload::widget(
                        [
                            'model' => $model,
                            'group' => 'file',
                        ]
                    );
                    ?>
                </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-4">
                <?php Panel::begin([
                    'title' => 'بارگذاری'
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('<i class="fa fa-save"></i> ذخیره', [
                        'class' => 'btn btn-lg btn-success'
                    ]) ?>
                    <?= Button::widget([
                        'label' => 'انصراف',
                        'options' => ['class' => 'btn-lg close-sliding-form-button'],
                        'type' => 'warning',
                        'icon' => 'undo',
                        'url' => $backLink,
                    ])
                    ?>
                </div>
                <?php Panel::end() ?>
            </div>
        </div>

        <?php Panel::end() ?>
        <?php ActiveForm::end(); ?>
    </div>

<?php $this->registerJs('
    $("#hidden-typeId").val($(".ajaxcreate").attr("data-typeId"));
');