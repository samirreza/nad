<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use core\widgets\editor\Editor;
use core\widgets\select2\Select2;
use yii\helpers\ArrayHelper;
use nad\office\modules\expert\models\Expert;

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
                    <div class="row">
                        <?php if($showReceiver == "T"): ?>
                            <div class="col-md-4">
                            <?= $form->field($comment, 'receiverId')->widget(
                                    Select2::class,
                                    [
                                        'data' => ArrayHelper::map(
                                            Expert::getExpertsByPermission('expert'),
                                            'id',
                                            'user.fullName'
                                        ),
                                        'options' => [
                                            'placeholder' => 'همه کارشناسان'
                                        ],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]
                                ) ?>
                            </div>
                        <div class="col-md-4">
                            <br>
                            <?= $form->field($comment, 'isSecret')->checkbox(
                                [
                                    'value' => "T",
                                    'uncheck' => 'F',
                                ]
                            ) ?>
                        </div>
                        <?php endif; ?>
                        <div class="col-md-4">
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
                        </div>
                    </div>
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
