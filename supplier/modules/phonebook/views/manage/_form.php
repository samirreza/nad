<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use theme\widgets\Panel;
use theme\widgets\Button;
use modules\nad\supplier\modules\phonebook\models\Job;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;
$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];
?>
    <div class="phonebook-form">

        <?php $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
                'class' => 'sliding-form'
            ]
        ]); ?>

        <?= Html::activeHiddenInput($model, 'supplierId', ['id' => 'hidden-supplierId']) ?>

        <?php Panel::begin([
            'title' => 'اطلاعات تماس',
            'showCloseButton' => true
        ]) ?>
        <div class="row">
            <div class="col-md-8">
                <?php Panel::begin() ?>
                <?=
                $form->field($model, 'jobId')
                    ->dropDownList(
                        ArrayHelper::map(Job::find()->all(), 'id', 'title'),
                        [
                            'class' => 'form-control input-large',
                            'prompt' => 'انتخاب کنید...'
                        ]
                    )
                ?>
                <?=
                $form->field($model, 'name')
                    ->textInput(
                        [
                            'maxlength' => 255,
                            'class' => 'form-control input-large'
                        ]
                    )
                ?>
                <?=
                $form->field($model, 'phone')
                    ->textInput(
                        [
                            'maxlength' => 11,
                            'class' => 'form-control input-large',
                            'style' => 'direction: ltr;'
                        ]
                    )
                ?>
                <?=
                $form->field($model, 'email')
                    ->textInput(
                        [
                            'class' => 'form-control input-large',
                            'style' => 'direction: ltr;'
                        ]
                    )
                ?>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-4">
                <?php Panel::begin([
                    'title' => 'ذخیره اطلاعات'
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('<i class="fa fa-save"></i> ذخیره', [
                        'class' => 'btn btn-lg btn-success'
                    ]) ?>
                    <?= Button::widget([
                        'label' => 'انصراف',
                        'options' => ['class' => 'btn-lg close-sliding-form-button'],
                        'type' => 'warning',
                        'icon' => 'undo',
                        'url' => $backLink,
                    ])
                    ?>
                </div>
                <?php Panel::end() ?>
            </div>
        </div>
        <?php Panel::end() ?>
        <?php ActiveForm::end(); ?>
    </div>

<?php $this->registerJs('
    $("#hidden-supplierId").val($(".ajaxcreate").attr("data-supplierId"));
');
