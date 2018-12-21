<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use core\widgets\editor\Editor;
use extensions\tag\widgets\selectTag\SelectTag;
use nad\research\modules\resource\widgets\selectResource\SelectResource;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];

?>

<div class="proposal-form">
    <?php $form = ActiveForm::begin() ?>
        <div class="row">
            <div class="col-md-8">
            <?php Panel::begin(['title' => 'مشخصات پروپوزال']) ?>
                    <?= $form->field($model, 'title')->textInput([
                        'maxlength' => 255,
                        'class' => 'form-control input-large'
                    ]) ?>
                    <?= $form->field($model, 'necessity')->widget(
                        Editor::class,
                        ['preset' => 'advanced']
                    ) ?>
                    <?= $form->field($model, 'mainPurpose')->widget(
                        Editor::class,
                        ['preset' => 'advanced']
                    ) ?>
                    <?= $form->field($model, 'secondaryPurpose')->widget(
                        Editor::class,
                        ['preset' => 'advanced']
                    ) ?>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-4">
                <?php Panel::begin(['title' => 'سایر اطلاعات پروپوزال']) ?>
                    <?= $form->field($model, 'code')->textInput([
                        'maxlength' => 255,
                        'class' => 'form-control input-large'
                    ])->hint('۴ کاراکتر بزرگ لاتین') ?>
                    <?= $form->field($model, 'resources')->widget(SelectResource::class) ?>
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
