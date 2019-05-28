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
use nad\common\modules\investigation\source\models\SourceReason;
use nad\common\modules\investigation\reference\widgets\selectReference\SelectReference;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];

?>

<div class="source-form">
    <?php Panel::begin(['title' => 'مشخصات منشا']) ?>
        <?php $form = ActiveForm::begin() ?>
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
                    <?= $form->field($model, 'reasonForGenesis')->widget(
                        Editor::class,
                        ['preset' => 'advanced']
                    ) ?>
                    <?= $form->field($model, 'necessity')->widget(
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
