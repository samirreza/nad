o<?php

use yii\web\View;
use theme\widgets\Panel;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use core\widgets\select2\Select2;
use nad\rla\models\RowLevelAccessPreview;
use nad\rla\models\RowLevelAccess;
use yii\helpers\ArrayHelper;
use extensions\jstree\widgets\JsTree;
use yii\helpers\Url;
use theme\widgets\jalalidatepicker\DatePickerAsset;

$datePickerBundle = DatePickerAsset::register($this);


$this->registerJs("
$(document).on('select2:select', '#myUserIds', function (e) {
    let data = e.params.data;
    let rowHtml = '<div class=\"col-md-12\" data-id=\"' + data.id + '\">'+
    '<hr><div class=\"col-md-4\" style=\"margin-top:10px\">' + data.text + '</div>'+
    '<div class=\"form-group field-rowlevelaccesspreview-access-types col-md-4\">'+
    '<div class=\"checkbox\">'+
    '<label for=\"RowLevelAccessPreview[accessTypes][' + data.id + ']\">'+
    '<input type=\"hidden\" name=\"RowLevelAccessPreview[accessTypes][' + data.id + ']\" value=\"1\">' +
    '<input type=\"checkbox\" class=\"checkbox-access-type\" id=\"rowlevelaccesspreview-access-types\" name=\"RowLevelAccessPreview[accessTypes][' + data.id + ']\" value=\"2\">'+
    'دسترسی موقت'+
    '</label>'+
    '</div>'+
    '</div>'+
    '<div class=\"form-group col-md-4\">'+
    '<input type=\"text\" name=\"RowLevelAccessPreview[expireDates][' + data.id + ']\" class=\"form-control datepicker\" placeholder=\"تاریخ انقضا\" disabled=\"disabled\">'+
    '</div>'+
    '</div>';
    $('#users_list').append(rowHtml);
    setDatePicker();
});

$(document).on('select2:unselect', '#myUserIds', function (e) {
    let data = e.params.data;
    $('#users_list > div[data-id=\"' + data.id + '\"]').remove();
});

$(document).on('select2:clear', '#myUserIds', function (e) {
    $('#users_list').html('');
});

$(document).on('click', '.checkbox-access-type', function(){
    let myDatepicker = $(this).parent().parent().parent().parent().find('.datepicker');
    myDatepicker.prop('disabled', function(i, v) { return !v; });
    if(!$(this).is(':checked')){
        myDatepicker.val('');
    }
});

function setDatePicker(){
    $('.datepicker').datepicker({isRTL: true, dateFormat: \"yy/mm/dd\", weekStart: 0});
}
", View::POS_END, "users_list_handler");

$this->registerJS("$(function(){
    $('#rla_grant_revoke_preview').on('beforeSubmit', function(){
        let selectedModules = $('#jstree_container').jstree('get_selected');

        let hiddenInputForItemTypes =  $('#RowLevelAccessPreview_itemTypes');
        if(hiddenInputForItemTypes.length === 0 || hiddenInputForItemTypes == 'undefined')
            $('#rla_grant_revoke_preview').append('<input id=\"RowLevelAccessPreview_itemTypes\" type=\"hidden\" name=\"RowLevelAccessPreview[itemTypes]\" />');

        let finalSelectedModules = [];
        $.each(selectedModules, function(key, value){
            if(!value.startsWith('j'))
                finalSelectedModules.push(value);
        });
        let tmpValue = JSON.stringify(finalSelectedModules);
        if(tmpValue == '[]'){
            notify('لطفا داده گاه را انتخاب کنید', 'error');

            return false;
        }
        $('#RowLevelAccessPreview_itemTypes').val(tmpValue);

        $.post($('#rla_grant_revoke_preview').attr('action'), $('#rla_grant_revoke_preview').serialize(), function(response) {
            notify(response, 'success');
        });

        return false;
    });
});", View::POS_END, "form-submit-handler");

$this->registerJS("$(function(){
    $('#refresh_user_ids').on('click', function(event){
        let selectedModules = $('#jstree_container').jstree('get_selected');
        $.get('" . Url::to(['get-users-by-item-type']) . "', {itemTypes: JSON.stringify(selectedModules)}, function(response) {
            console.log(response);
            $('#myUserIds').val(response);
            $('#myUserIds').trigger('change');
        });
    });
});", View::POS_END, "refresh-users-ids-handler");

$widget = JsTree::widget([
    'dataArray' => RowLevelAccess::getItemTypes()
]);
?>

<h3 class="nad-page-title">اعطا/لغو دسترسی پیش نمایش داده گاه ها</h3>
<br>
<div class="rla-grant-revoke-preview">
    <?php $form = ActiveForm::begin([
        'id' => 'rla_grant_revoke_preview',
        'action' => ['grant-revoke-preview'],
        'method' => 'post',
    ]); ?>

    <div class="row well">
        <div class="col-md-4">
            <p><b><u>درخت داده گاه</u></b></p>
            <div id="jstree_container"></div>
        </div>
        <div class="col-md-8">
            <p style="text-align: justify"><i class="fa fa-hand-o-right"></i>&nbsp; جهت اعطا یا لغو دسترسی، ابتدا داده گاه مورد نظر را از درخت سمت راست انتخاب و سپس دکمه «بروزرسانی لیست کاربران» را کلیک کنید تا کاربرانی که قبلا به آنها دسترسی اعطا کرده اید در لیست زیر نمایش داده شوند و بتوانید نفرات لیست را کم یا زیاد کنید. توجه کنید درصورتی که چند داده گاه انتخاب کنید لیست کاربران خالی نمایش داده خواهد شد.
            <?= $form->field($modelTemplate, 'userIds')->widget(
                            Select2::class,
                            [
                                'data' => ArrayHelper::map(
                                    $experts,
                                    'userId',
                                    'user.fullName'
                                ),
                                'options' => [
                                    'id' => 'myUserIds',
                                    'name' => 'RowLevelAccessPreview[userIds]',
                                    'placeholder' => 'کاربران مجاز را انتخاب کنید ...',
                                    'multiple' => true,
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ]
                            ]
                )->label(false)
            ?>

            <br>
            <div id="users_list"></div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <br>
                    <?= Html::button('بروزرسانی لیست کاربران', ['id' => 'refresh_user_ids', 'class' => 'btn btn-primary']) ?>
                </div>
                <div class="col-md-3">
                    <br>
                    <?= Html::submitButton('ثبت نهایی', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
    <?php ActiveForm::end(); ?>
</div>
