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
use yii\grid\GridView;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];
// $uploadedFiles = $model->getFiles('file');

if(!$model->isNewRecord){
    $this->registerJS(
    "$(document).ready(function(){
        $('#excel_form').submit(function(event){
            let c = 0;
            $('#excel_rows_grid .hidden-cell-value').remove();
            $('#excel_rows_grid').find(':input:not([readonly])').each(function(index){
                console.log(++c);
                let rowParent = $(this).parent().parent();
                let rowNum = $(rowParent).data('key');
                $('<input />').attr('type', 'hidden')
                    .attr('class', 'hidden-cell-value')
                    .attr('name', 'rows[' + rowNum + '][' + $(this).data('name') + ']')
                    .attr('value', $(this).val())
                    .appendTo('#excel_form');
            });
            return true;
        });
    });", View::POS_END, "form-submit-handler");
}

?>
<div class="form">
    <?php $form = ActiveForm::begin(
        [
            'options' => [
                'enctype' => 'multipart/form-data',
                'id' => 'excel_form'
            ]
        ]
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
                    <div class="alert alert-info" role="alert">توجه: فایل اکسل باید به ساده ترین شکل ممکن باشد، حاوی عکس نبوده و سطر و ستونها نیز ادغام نشده باشند.</div>
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
            </div>
        </div>
    </div>
    <?php Panel::end() ?>
    <?php ActiveForm::end(); ?>
</div>

<?php if(!$model->isNewRecord): ?>
    <div class="row">
        <div class="col-md-12">
            <?php Panel::begin([
                'title' => 'ردیفهای فایل اکسل'
            ]) ?>
            <p><i class="fa fa-hand-o-right"></i>
جهت ویرایش اطلاعات هر سلول جدول، روی آن دو بار کلیک کنید.
            </p>
            <br>
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterUrl' => false,
                    'options' =>[
                        'style' => 'overflow-x:auto;',
                        'id' => 'excel_rows_grid'
                    ],
                    'columns' => array_merge(
                        [
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'options' => [
                                    'width' => '20px'
                                ]
                            ]
                        ],
                        $columns
                    )
                ])
                ?>
            <?php Panel::end() ?>
        </div>
    </div>
<?php endif; ?>

