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
use nad\common\modules\excelmanager\models\ExcelFile;
use extensions\file\widgets\singleupload\SingleFileUpload;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];
// $uploadedFiles = $model->getFiles('file');
?>
<div class="form">
    <?php $form = ActiveForm::begin(
        ['options' => ['enctype' => 'multipart/form-data']]
    ) ?>
    <?php Panel::begin([
        'title' => 'اطلاعات اصلی',
    ]) ?>
    <div class="row">
        <div class="col-md-9">
            <?php Panel::begin() ?>
            <div class="row">
                <div class="col-md-5">
                <?= $form->field($model, 'title')->textInput(['maxlength' => 255,
                        'class' => 'form-control']) ?>
                </div>
                <div class="col-md-4">
                <?= $form->field($model, 'uniqueCode')->textInput(['maxlength' => 128,
                        'class' => 'form-control', 'dir' => 'ltr']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <?php Panel::begin() ?>
                            <label>فایل اکسل</label>
                            <?= SingleFileUpload::widget([
                                'model' => $model,
                                'group' => 'file',
                            ]) ?>
                    <?php Panel::end() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <?= $form->field($model, 'description')->textarea([
                        'class' => 'form-control']) ?>
                </div>
            </div>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-3">
            <div class="col-sm-12">
                <?php Panel::begin() ?>
                    <?=
                        Html::submitButton(
                            '<i class="fa fa-save"></i> ذخیره',
                            ['class' => 'btn btn-xs btn-warning']
                        )
                    ?>
                    <?= Button::widget([
                            'label' => 'انصراف',
                            'options' => ['class' => 'btn-lg'],
                            'type' => 'warning',
                            'icon' => 'undo',
                            'url' => $backLink
                        ])
                    ?>
                <?php Panel::end() ?>
            </div>
        </div>
    </div>
    <?php Panel::end() ?>
    <?php ActiveForm::end(); ?>
</div>
