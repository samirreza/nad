<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use modules\nad\equipment\widgets\EquipmentsSelect2;
use modules\nad\equipment\widgets\EquipmentPartsSelect2;
use nad\research\modules\material\widgets\MaterialsSelect2;

?>

<div class="post-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-12">
            <?php Panel::begin([
                'title' => 'جستجوی تامین کننده بر اساس تجهیزات، مواد و قطعات'
            ]) ?>

            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'equipments')->widget(EquipmentsSelect2::class) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'materials')->widget(MaterialsSelect2::class) ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'parts')->widget(EquipmentPartsSelect2::class) ?>
                </div>
                <div class="col-md-3">
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
