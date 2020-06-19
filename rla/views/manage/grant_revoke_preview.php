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
            showNotification('لطفا داده گاه را انتخاب کنید', 'error');

            return false;
        }
        $('#RowLevelAccessPreview_itemTypes').val(tmpValue);

        $.post($('#rla_grant_revoke_preview').attr('action'), $('#rla_grant_revoke_preview').serialize(), function(response) {
            showNotification(response, 'info');

        });

        return false;
    });
});", View::POS_END, "form-submit-handler");

$this->registerJS("$(function(){
    $('#refresh_users_list').on('click', function(event){
        let selectedModules = $('#jstree_container').jstree('get_selected');
        $.get('" . Url::to(['get-users-by-item-type']) . "', {itemTypes: JSON.stringify(selectedModules)}, function(response) {
            console.log(response);
            $('#users_list').val(response);
            $('#users_list').trigger('change');
        });
    });
});", View::POS_END, "refresh-users-list-handler");

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
                                    'id' => 'users_list',
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

            <div class="row">
                <div class="col-md-4">
                    <br>
                    <?= Html::button('بروزرسانی لیست کاربران', ['id' => 'refresh_users_list', 'class' => 'btn btn-primary']) ?>
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
