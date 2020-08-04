<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use core\widgets\editor\Editor;

?>

<div class="comment-form">
    <div class="row">
        <div class="col-md-12">
            <?php Panel::begin() ?>
                <?php $form = ActiveForm::begin([
                    'enableClientValidation' => true,
                    'options' => [
                        'class' => 'sliding-form',
                        'data-sliding-form-wrapper-id' => 'comment-sliding-form-wrapper',
                    ]
                ]) ?>
                    <?= Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        [
                            'class' => 'btn btn-xs btn-warning'
                        ]
                    ) ?>
                    <?= Button::widget([
                            'label' => 'انصراف',
                            'options' => [
                                'class' => 'btn-lg close-sliding-form-button',
                                'data-sliding-form-wrapper-id' => 'comment-sliding-form-wrapper'
                            ],
                            'type' => 'warning',
                            'icon' => 'undo'
                        ])
                    ?>
                    <?= $form->field($comment, 'content')
                        ->widget(
                            Editor::class,
                            [
                                'preset' => 'simple',
                                'clientOptions' => [
                                    'contentsCss' => ["body {font-size: 20px;}"],
                                ]
                            ]
                        )
                    ?>
                <?php ActiveForm::end() ?>
            <?php Panel::end() ?>
        </div>
    </div>
</div>
