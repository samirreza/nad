<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use theme\widgets\editor\Editor;
use extensions\tag\widgets\selectTag\SelectTag;
use theme\widgets\jalalidatepicker\JalaliDatePicker;
use extensions\file\widgets\singleupload\SingleFileUpload;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];

?>

<div class="project-form">
    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]) ?>
        <div class="row">
            <div class="col-md-8">
            <?php Panel::begin(['title' => 'مشخصات پروژه']) ?>
                    <?= $form->field($model, 'title')->textInput([
                        'maxlength' => 255,
                        'class' => 'form-control input-large'
                    ]) ?>
                    <?= $form->field($model, 'researcherName')->textInput([
                        'maxlength' => 255,
                        'class' => 'form-control input-large'
                    ]) ?>
                    <?= $form->field($model, 'complationDate')->widget(
                        JalaliDatePicker::class,
                        [
                            'options' => [
                                'class' => 'form-control input-small',
                                'autocomplete' => 'off'
                            ]
                        ]
                    ) ?>
                    <br>
                    <div class="input-small">
                        <?= SingleFileUpload::widget([
                            'model' => $model,
                            'group' => 'report'
                        ]) ?>
                    </div>
                    <br>
                    <?= $form->field($model, 'abstract')->widget(
                        Editor::class,
                        ['preset' => 'advanced']
                    ) ?>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-4">
                <?php Panel::begin(['title' => 'سایر اطلاعات پروژه']) ?>
                    <?= $form->field($model, 'tags')->widget(SelectTag::class) ?>
                <?php Panel::end() ?>
                <?php Panel::begin() ?>
                    <?= Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        [
                            'class' => 'btn btn-lg btn-success'
                        ]
                    ) ?>
                    <?= Button::widget([
                        'label' => 'انصراف',
                        'options' => ['class' => 'btn-lg'],
                        'type' => 'warning',
                        'icon' => 'undo',
                        'url' => $backLink
                    ]) ?>
                <?php Panel::end() ?>
            </div>
        </div>
    <?php ActiveForm::end() ?>
</div>
