<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use yii\widgets\DetailView;
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
        <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'type',
                        'value' => function($model){
                            return Lookup::item('nad.rla.request.Type', $model->type);
                        }
                    ],
                    [
                        'attribute' => 'description',
                        'format' => 'html',
                        'value' => function($model){
                            return nl2br($model->description);
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function($model){
                            return Lookup::item('nad.rla.request.Status', $model->status);
                        },
                    ],
                ],
            ])
        ?>
        <?php if(RowLevelAccessRequest::isCurrentUserMainAdmin() || $model->status != RowLevelAccessRequest::REQUEST_STATUS_REJECTED_BY_MANAGER): ?>
            <hr>
            <?php $form = ActiveForm::begin() ?>
                <div class="row">
                    <div class="col-md-3">
                    <?= $form->field($model, 'status')->widget(
                            Select2::class,
                            [
                                'data' => RowLevelAccessRequest::getStatusOptions(),
                                'options' => [
                                    'placeholder' => 'انتخاب کنید'
                                ],
                            ]
                        )->label('تغییر وضعیت') ?>
                    </div>
                    <div class="col-md-4 pull-right">
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
            <?php ActiveForm::end() ?>
            <br>
        <?php endif; ?>
    <?php Panel::end() ?>
</div>