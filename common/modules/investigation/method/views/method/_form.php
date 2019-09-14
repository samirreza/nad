<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use core\widgets\editor\Editor;
use extensions\tag\widgets\selectTag\SelectTag;
use theme\widgets\jalalidatepicker\JalaliDatePicker;
use extensions\file\widgets\singleupload\SingleFileUpload;
use nad\common\modules\investigation\reference\widgets\selectReference\SelectReference;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];

?>

<div class="method-form">
    <?php Panel::begin(['title' => 'مشخصات روش']) ?>
        <?php $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data'
            ]
        ]) ?>
            <div class="row">
                <div class="col-md-8">
                    <?= $form->field($model, 'title')->textInput([
                        'maxlength' => 255,
                        'class' => 'form-control input-large'
                    ]) ?>
                    <?= $form->field($model, 'englishTitle')->textInput([
                        'maxlength' => 255,
                        'class' => 'form-control input-large'
                    ]) ?>
                    <?= $form->field($model, 'createdAt')->widget(
                        JalaliDatePicker::class,
                        [
                            'options' => [
                                'class' => 'form-control input-small',
                                'autocomplete' => 'off'
                            ]
                        ]
                    ) ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?= SingleFileUpload::widget([
                                'model' => $model,
                                'group' => 'instruction',
                                'label' => 'فایل دستورالعمل'
                            ]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <?= Html::submitButton('ذخیره', [
                        'class' => 'btn btn-lg btn-warning'
                    ]) ?>
                    <?= Button::widget([
                        'label' => 'انصراف',
                        'options' => ['class' => 'btn-lg'],
                        'type' => 'warning',
                        'icon' => false,
                        'url' => $backLink
                    ]) ?>
                    <br><br>
                    <?= SingleFileUpload::widget([
                        'model' => $model,
                        'group' => 'document',
                        'label' => 'مدارک'
                    ]) ?>
                    <?= $form->field($model, 'references')->widget(
                        SelectReference::class,
                        [
                            'consumer' => $consumer
                        ]
                    ) ?>
                    <?= $form->field($model, 'tags')->widget(SelectTag::class) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'abstract')->widget(
                        Editor::class,
                        ['preset' => 'advanced']
                    ) ?>
                    <?= $form->field($model, 'description')->widget(
                        Editor::class,
                        ['preset' => 'advanced']
                    ) ?>
                </div>
            </div>
        <?php ActiveForm::end() ?>
    <?php Panel::end() ?>
</div>
