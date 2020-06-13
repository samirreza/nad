<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use theme\widgets\editor\Editor;
use nad\rla\models\RowLevelAccessRequest;
use nad\common\helpers\Lookup;
use core\widgets\select2\Select2;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];

?>

<div class="request-form">
    <?php Panel::begin(['title' => 'مشخصات درخواست']) ?>
        <?php $form = ActiveForm::begin() ?>
            <div class="row">
                <div class="col-md-3">
                <?= $form->field($model, 'type')->widget(
                        Select2::class,
                        [
                            'data' => Lookup::items('nad.rla.request.Type'),
                            'options' => [
                                'placeholder' => 'انتخاب کنید'
                            ],
                        ]
                    ) ?>
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
                <div class="col-md-12">
                    <?= $form->field($model, 'description')->widget(
                        Editor::class,
                        ['preset' => 'advanced']
                    ) ?>
                </div>
            </div>
        <?php ActiveForm::end() ?>
    <?php Panel::end() ?>
</div>