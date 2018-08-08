<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\Button;
use modules\nad\supplier\backend\modules\phonebook\models\Job;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];
?>
<div class="phonebook-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-8">
            <?php Panel::begin([
                'title' => 'اطلاعات تماس'
            ]) ?>
            <?=
            $form->field($model, 'supplierId')
                ->hiddenInput(
                    [
                        'id' => 'supplierId',
                        'value' => $supplierId
                    ]
                )->label(false)
            ?>
            <?=
            $form->field($model, 'jobId')
                ->dropDownList(
                    ArrayHelper::map(Job::find()->all(), 'id', 'title'),
                    [
                        'class' => 'form-control input-large',
                        'prompt' => 'انتخاب کنید...'
                    ]
                )
            ?>
            <?=
            $form->field($model, 'name')
                ->textInput(
                    [
                        'maxlength' => 255,
                        'class' => 'form-control input-large'
                    ]
                )
            ?>
            <?=
            $form->field($model, 'phone')
                ->textInput(
                    [
                        'maxlength' => 11,
                        'class' => 'form-control input-large'
                    ]
                )
            ?>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-4">
            <?php Panel::begin([
                'title' => 'ذخیره اطلاعات'
            ]) ?>
            <div class="form-group">
                <?= Html::submitButton('<i class="fa fa-save"></i> ذخیره', [
                    'class' => 'btn btn-lg btn-success'
                ]) ?>
                <?= Button::widget([
                    'label' => 'انصراف',
                    'options' => ['class' => 'btn-lg'],
                    'type' => 'warning',
                    'icon' => 'undo',
                    'url' => ['/supplier/phonebook/manage/list', 'supplierId' => $supplierId],
                ])
                ?>
            </div>
            <?php Panel::end() ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>