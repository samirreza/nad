<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use core\widgets\editor\Editor;
use core\widgets\select2\Select2;
use extensions\tag\widgets\selectTag\SelectTag;
use extensions\file\widgets\singleupload\SingleFileUpload;
use nad\common\modules\investigation\reference\models\Reference;
use nad\common\modules\investigation\reference\models\ReferenceUses;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;

?>

<div class="row">
    <div class="col-md-12">
        <?php Panel::begin([
            'title' => 'اطلاعات منبع',
            'showCloseButton' => true
        ]) ?>
            <div class="reference-form">
                <?php $form = ActiveForm::begin([
                    'enableClientValidation' => true,
                    'options' => [
                        'class' => 'sliding-form',
                        'enctype' => 'multipart/form-data'
                    ]
                ]) ?>
                    <div class="col-md-6">
                        <?= $form->field($model, 'title')->textInput() ?>
                        <?= $form->field($model, 'type')->dropDownList(
                            Reference::getTypeLabels()
                        ) ?>
                        <?= $form->field($model, 'author')->textInput() ?>
                        <?= $form->field($model, 'publishedYear')->textInput() ?>
                        <?= $form->field($model, 'publisher')->textInput() ?>
                        <?= $form->field($model, 'tags')->widget(SelectTag::class) ?>
                        <?= $form->field($model, 'referenceUses')->widget(
                            Select2::class,
                            [
                                'data' => ReferenceUses::getCodes(),
                                'options' => [
                                    'multiple' => true,
                                    'placeholder' => 'انتخاب کنید ...',
                                    'value' => $model->getCodesAsArray()
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ]
                            ]
                        ) ?>
                        <div class="input-medium">
                            <?= SingleFileUpload::widget([
                                'model' => $model,
                                'group' => 'resource',
                                'label' => 'فایل منبع'
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= Html::submitButton('<i class="fa fa-save"></i> ذخیره', [
                                'class' => 'btn btn-xs btn-warning'
                            ]) ?>
                            <?= Button::widget([
                                'label' => 'انصراف',
                                'options' => ['class' => 'btn-lg close-sliding-form-button'],
                                'type' => 'warning',
                                'icon' => 'undo'
                            ]) ?>
                        </div>
                        <?= $form->field($model, 'description')->widget(
                            Editor::class,
                            ['preset' => 'advanced']
                        ) ?>
                    </div>
                <?php ActiveForm::end() ?>
            </div>
        <?php Panel::end() ?>
    </div>
</div>
