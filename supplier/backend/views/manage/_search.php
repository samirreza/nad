<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use themes\admin360\widgets\Panel;
use \modules\nad\equipment\modules\type\models\Type as EquipmentType;
use \modules\nad\material\modules\type\models\Type as MaterialType;


?>

<div class="post-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-12">
            <?php Panel::begin([
                'title' => 'جستجوی تامین کننده بر اساس تجهیزات و مواد'
            ]) ?>

            <div class="row">
                <div class="col-md-4">
                    <?=
                    $form->field($model, 'equipments')
                        ->widget(
                            Select2::class,
                            [
                                'data' => ArrayHelper::map(
                                    EquipmentType::find()->all(),
                                    'title',
                                    'title'
                                ),
                                'options' => [
                                    'class' => 'form-control input-large',
                                    'placeholder' => 'انتخاب کنید ...'
                                ]
                            ]
                        );
                    ?>
                </div>
                <div class="col-md-4">
                    <?=
                    $form->field($model, 'materials')
                        ->widget(
                            Select2::class,
                            [
                                'data' => ArrayHelper::map(
                                    MaterialType::find()->all(),
                                    'title',
                                    'title'
                                ),
                                'options' => [
                                    'class' => 'form-control input-large',
                                    'placeholder' => 'انتخاب کنید ...'
                                ]
                            ]
                        );
                    ?>
                </div>
                <div class="col-md-4">
                    <div class="form-group" style="margin-top: 9%;">
                        <?= Html::submitButton('جستجو', ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>


            <?php Panel::end() ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>
</div>