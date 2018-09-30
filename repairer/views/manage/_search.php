<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use theme\widgets\Panel;
use theme\widgets\Button;
use modules\nad\equipment\widgets\EquipmentsSelect2;
use modules\nad\equipment\widgets\EquipmentPartsSelect2;
?>

<div class="repairer-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-12">
            <?php Panel::begin([
                'title' => 'جستجوی تعمیرکار بر اساس تجهیزات و قطعات'
            ]) ?>

            <div class="row">
                <div class="col-md-5">
                    <?= $form->field($model, 'equipments')->widget(EquipmentsSelect2::class) ?>
                </div>
                <div class="col-md-5">
                    <?= $form->field($model, 'parts')->widget(EquipmentPartsSelect2::class) ?>
                </div>
                <div class="col-md-2">
                    <div class="form-group" style="margin-top: 25px;">
                        <?= Html::submitButton(
                            '<i class="fa fa-search"></i>',
                            ['class' => 'btn btn-success']
                        ) ?>
                        <?= Button::widget([
                            'label' => '',
                            'type' => 'warning',
                            'icon' => 'undo',
                            'url' => ['index'],
                        ])
                        ?>
                    </div>
                </div>
            </div>
            <?php Panel::end() ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
