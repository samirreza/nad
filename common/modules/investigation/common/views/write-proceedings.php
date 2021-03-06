<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use core\widgets\editor\Editor;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;

?>

<div class="row">
    <div class="col-md-12">
        <?php Panel::begin([
            'title' => 'نتیجه جلسه',
            'showCloseButton' => true
        ]) ?>
            <div class="session-proceedings-form">
                <?php $form = ActiveForm::begin([
                    'enableClientValidation' => true,
                    'options' => [
                        'class' => 'sliding-form'
                    ]
                ]) ?>
                    <?= $form->field($model, 'proceedings')->widget(
                        Editor::class,
                        ['preset' => 'advanced']
                    ) ?>
                    <br>
                    <?= Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        [
                            'class' => 'btn btn-xs btn-warning'
                        ]
                    ) ?>
                    <?= Button::widget([
                        'label' => 'انصراف',
                        'options' => [
                            'class' => 'btn-lg close-sliding-form-button'
                        ],
                        'type' => 'warning',
                        'icon' => 'undo'
                    ]) ?>
                <?php ActiveForm::end() ?>
            </div>
        <?php Panel::end() ?>
    </div>
</div>
