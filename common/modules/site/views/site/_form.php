<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use nad\common\helpers\Lookup;
use core\widgets\select2\Select2;
use nad\common\modules\site\models\Site;
use nad\common\modules\engineering\stage\models\Category;
use extensions\file\widgets\singleupload\SingleFileUpload;

Yii::$app->assetManager->bundles['yii\bootstrap\BootstrapAsset'] = false;
$stageCategory = Category::findOne(['id' => $model->stageCategoryId]);

$this->registerJs(
    "$('#" . Html::getInputId($model, "stageCategoryId") . "').on('change', function() {
        let self = $(this);
        $.get('" . Url::to(['get-stage-title-and-code']) . "',
        {
            stageId: self.val()
        },
        function(response){
            $('#stageCategoryFamilyTreeTitle').val(response.familyTreeTitle);
            $('#stageCategoryCode').val(response.code);
        });
    });
    ",
    View::POS_END,
    'my-js-handler'
);

?>
<div class="form">
    <?php $form = ActiveForm::begin([
        'options'=>['class' => 'sliding-form']
    ]); ?>
    <?php Panel::begin([
        'title' => 'اطلاعات اصلی',
        'showCloseButton' => true
    ]) ?>
    <div class="row">
        <div class="col-md-9">
            <?php Panel::begin() ?>
            <div class="row">
                <div class="col-md-4">
                <?= $form->field($model, 'stageCategoryId')->widget(
                        Select2::class,
                        [
                            'data' => Site::getAllStages(),
                            'options' => [
                                'placeholder' => 'انتخاب کنید...'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]
                    ) ?>
                </div>
                <div class="col-md-8">
                    <?php
                        echo '<br>';
                        echo Html::textInput(
                            'stageCategoryFamilyTreeTitle',
                            isset($stageCategory)?$stageCategory->familyTreeTitle:'رده مرحله را انتخاب کنید',
                            [
                                'id' => 'stageCategoryFamilyTreeTitle',
                                'disabled' => 'true',
                                'class' => 'form-control',
                            ]
                        );
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <?= $form->field($model, 'code')->textInput(
                        [
                            'class' => 'form-control',
                            'style' => 'direction:ltr',
                            'maxlength' => 10
                        ]
                    );//->hint('تنها یک کاراکتر لاتین')
                    ?>
                </div>
                <div class="col-md-6">
                 <div class="form-group field-stageCategoryCode">
                    <label class="control-label" for="stageCategoryCode">
                    شناسه مرحله
                    </label>
                    <?=
                        Html::textInput(
                            'stageCategoryCode',
                            isset($stageCategory)?$stageCategory->code:'رده مرحله را انتخاب کنید',
                            [
                                'id' => 'stageCategoryCode',
                                'disabled' => 'true',
                                'class' => 'form-control input-medium',
                            ]
                        );
                    ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                <?= $form->field($model, 'deviceTitle')->textInput(['maxlength' => 255,
                        'class' => 'form-control input-large']) ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'deviceCode')->textInput(['maxlength' => 255,
                        'class' => 'form-control input-large', 'dir' => 'ltr']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                <?= $form->field($model, 'coordinatesType')->dropDownList(
                        Lookup::items(Site::LOOKUP_COORDINATES_TYPE),
                        ['prompt'=>'انتخاب کنید']
                    ) ?>
                </div>
                <div class="col-md-3">
                <?= $form->field($model, 'coordinates')->textInput(['maxlength' => 255,
                        'class' => 'form-control input-large', 'dir' => 'ltr']) ?>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-9">
                    <?= $form->field($model, 'description')->textarea([
                        'class' => 'form-control']) ?>
                </div>
            </div>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-3">
            <?php Panel::begin() ?>
                <?=
                    Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        ['class' => 'btn btn-xs btn-warning']
                    )
                ?>
                <?= Button::widget([
                        'label' => 'انصراف',
                        'options' => ['class' => 'btn-lg close-sliding-form-button'],
                        'type' => 'warning',
                        'icon' => 'undo'
                    ])
                ?>
            <?php Panel::end() ?>
        </div>
    </div>
    <?php Panel::end() ?>
    <?php ActiveForm::end(); ?>
</div>
