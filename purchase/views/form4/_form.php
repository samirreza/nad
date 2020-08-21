<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use theme\widgets\editor\Editor;
use theme\widgets\Panel;
use core\widgets\select2\Select2;
use theme\widgets\Button;
use yii\helpers\ArrayHelper;
use nad\purchase\models\FormsLookup;
use nad\office\modules\expert\models\Expert;
use theme\widgets\jalalidatepicker\JalaliDatePicker;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];

/* @var $this yii\web\View */
/* @var $model nad\purchase\models\Form4 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form4-form">
    <?php Panel::begin(['title' => 'مشخصات درخواست وجه']) ?>
        <?php $form = ActiveForm::begin([
            'action' => $model->isNewRecord ? ['create'] : ['update', 'id' => $model->id]
        ]); ?>

            <?= $form->field($model, 'purchaseGlobalId')->hiddenInput()->label(false); ?>
            <?= $form->field($model, 'prevFormId')->hiddenInput()->label(false); ?>
            <?= $form->field($model, 'prevRecordId')->hiddenInput()->label(false); ?>
            <?= $form->field($model, 'prevExpertId')->hiddenInput()->label(false); ?>

            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'title')->textInput() ?>
                </div>
                <div class="col-md-4 col-md-offset-4 pull-right">
                    <br>
                    <div class="col-sm-12">
                        <?= Html::submitButton('ذخیره', [
                            'class' => 'btn btn-xs btn-warning action-button'
                        ]) ?>
                        <?= Button::widget([
                            'label' => 'انصراف',
                            'type' => 'warning',
                            'icon' => false,
                            'url' => $backLink
                        ]) ?>
                    </div>
                    <br><br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'factorNumber')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'technicalNumber')->textInput() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'price')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'productName')->textInput() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'accountNumber')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'accountOwnerName')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'accountBankName')->textInput() ?>
                </div>
            </div>
            <?php if($model->nextFormId == null || $model->nextExpertId == null): ?>
                <br/>
                <hr/>
                <br/>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'nextFormId')->widget(
                                Select2::class,
                                [
                                    'data' => ArrayHelper::map(
                                        FormsLookup::find()->all(),
                                        'id',
                                        'title'
                                    ),
                                    'options' => [
                                        'placeholder' => 'انتخاب کنید'
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]
                            ) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'nextExpertId')->widget(
                                Select2::class,
                                [
                                    'data' => ArrayHelper::map(
                                        Expert::getExpertsByPermission('expert'),
                                        'id',
                                        'user.fullName'
                                    ),
                                    'options' => [
                                        'placeholder' => 'انتخاب کنید'
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]
                            ) ?>
                    </div>
                </div>
                <br/>
                <br/>
            <?php endif; ?>
        <?php ActiveForm::end(); ?>
    <?php Panel::end() ?>
</div>
