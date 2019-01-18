<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use core\widgets\editor\Editor;
use core\widgets\select2\Select2;
use extensions\tag\widgets\selectTag\SelectTag;
use theme\widgets\jalalidatepicker\JalaliDatePicker;
use nad\research\extensions\resource\models\Resource;
use nad\research\investigation\source\models\SourceReason;
use nad\research\extensions\resource\widgets\selectResource\SelectResource;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];

?>

<div class="source-form">
    <?php $form = ActiveForm::begin() ?>
        <div class="row">
            <div class="col-md-8">
            <?php Panel::begin(['title' => 'مشخصات منشا']) ?>
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
                    <?= $form->field($model, 'reason')->widget(
                        Editor::class,
                        ['preset' => 'advanced']
                    ) ?>
                    <?= $form->field($model, 'necessity')->widget(
                        Editor::class,
                        ['preset' => 'advanced']
                    ) ?>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-4">
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
                <?php Panel::begin(['title' => 'سایر اطلاعات منشا']) ?>
                    <?= $form->field($model, 'code')->textInput([
                        'maxlength' => 255,
                        'class' => 'form-control input-large'
                    ])->hint('۴ کاراکتر بزرگ لاتین') ?>
                    <?= $form->field($model, 'mainReasonId')->widget(
                        Select2::class,
                        [
                            'data' => ArrayHelper::map(
                                SourceReason::find()->all(),
                                'id',
                                'title'
                            ),
                            'options' => [
                                'prompt' => 'علت اصلی را انتخاب کنید ...'
                            ]
                        ]
                    ) ?>
                    <?= $form->field($model, 'reasons')->widget(
                        Select2::class,
                        [
                            'data' => ArrayHelper::map(
                                SourceReason::find()->all(),
                                'title',
                                'title'
                            ),
                            'options' => [
                                'multiple' => true,
                                'prompt' => 'علل فرعی را انتخاب کنید ...',
                                'value' => $model->getReasonsAsArray()
                            ]
                        ]
                    ) ?>
                    <?= $form->field($model, 'resources')->widget(
                        SelectResource::class,
                        [
                            'clientId' => Resource::CLIENT_INVESTIGATION
                        ]
                    ) ?>
                    <?= $form->field($model, 'tags')->widget(SelectTag::class) ?>
                <?php Panel::end() ?>
            </div>
        </div>
    <?php ActiveForm::end() ?>
</div>
