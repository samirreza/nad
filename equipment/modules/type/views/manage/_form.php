<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\Button;
use core\widgets\select2\Select2;
use modules\nad\equipment\modules\type\models\Category;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];
?>
<div class="faq-form">
    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>
    <div class="row">
        <div class="col-md-8">
            <?php Panel::begin([
                'title' => 'اطلاعات اصلی'
            ]) ?>
            <div class="row">
                <div class="col-md-5">
                    <?= $form->field($model, 'title')->textInput() ?>
                </div>
                <div class="col-md-4">
                    <?=
                    $form->field($model, 'categoryId')
                        ->widget(
                            Select2::class,
                            [
                                'data' => ArrayHelper::map(Category::find()->all(), 'id', 'codedTitle'),
                                'options' => [
                                    'class' => 'form-control input-large'
                                ]
                            ]
                        );
                    ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'code')->textInput(
                        ['style' => 'direction:ltr', 'maxlength' => 1]
                    )->hint('تنها یک کاراکتر لاتین') ?>
                </div>
            </div>
            <?=
                $form->field($model, 'description')->textarea([])
            ?>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-4">
            <?php Panel::begin() ?>
                <?=
                    Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        ['class' => 'btn btn-lg btn-success']
                    )
                ?>
                <?= Button::widget([
                        'label' => 'انصراف',
                        'options' => ['class' => 'btn-lg'],
                        'type' => 'warning',
                        'icon' => 'undo',
                        'url' => $backLink,
                    ])
                ?>
            <?php Panel::end() ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
