<?php

use yii\web\View;
use yii\helpers\Url;
use theme\widgets\Panel;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use theme\widgets\Button;
use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use nad\office\modules\expert\models\Expert;
use modules\user\backend\models\User;
use nad\rla\models\RowLevelAccess;
use theme\widgets\jalalidatepicker\DatePickerAsset;

$datePickerBundle = DatePickerAsset::register($this);

?>

<div class="modal fade" id="access_modal" tabindex="-1" role="dialog" aria-labelledby="access_modal_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="access_modal_label">اعطا/لغو دسترسی</h4>
            </div>
        <div class="modal-body">

        <div class="row">
            <div class="col-md-12">
                    <div class="set-users-form">
                        <?php $form = ActiveForm::begin([
                            'action' => Url::to(['grant-revoke-access']),
                            'options' => [
                                'id' => 'set-users-form'
                            ]
                        ]) ?>
                            <p>
                            کاربران را به لیست زیر اضافه یا از لیست حذف کنید. تنها کاربرانی به رکوردهای مورد نظر دسترسی دارند که نام آنها در لیست موجود باشد:
                            </p>
                            <?= $modelTemplate->activeHiddenInputList($modelTemplate, 'seqAccessIds'); ?>

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
                                        'placeholder' => 'کاربران را انتخاب کنید ...',
                                        'multiple' => true,
                                        'value' => ArrayHelper::getColumn(
                                            $models,
                                            'user_id'
                                        )
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ]
                                ]
                            )->label(false) ?>

                            <br>

                            <div id="users_list" class="row">
                                <?php foreach ($models as $model): ?>
                                    <div class="col-md-12" data-id="<?= $model['user_id'] ?>">
                                        <hr>
                                        <div class="col-md-4" style="margin-top:10px">
                                            <?= User::findOne($model['user_id'])->fullName ?>
                                        </div>
                                        <div class="form-group field-rowlevelaccess-access-types col-md-4">
                                            <div class="checkbox">
                                                <label for="RowLevelAccess[accessTypes][<?= $model['user_id'] ?>]">
                                                <input type="hidden" name="RowLevelAccess[accessTypes][<?= $model['user_id'] ?>]" value="1">
                                                <input type="checkbox" class="modal-access-type" id="rowlevelaccess-access-types" name="RowLevelAccess[accessTypes][<?= $model['user_id'] ?>]" value="2" <?= $model['access_type'] == 2 ? 'checked' : '' ?> >
                                                دسترسی موقت
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <?php if($model['access_type'] == 1): ?>
                                                <input type="text" name="RowLevelAccess[expireDates][<?= $model['user_id'] ?>]" class="form-control datepicker" placeholder="تاریخ انقضا" disabled="disabled" >
                                            <?php endif; ?>
                                            <?php if($model['access_type'] == 2): ?>
                                                <input type="text" name="RowLevelAccess[expireDates][<?= $model['user_id'] ?>]" class="form-control datepicker" placeholder="تاریخ انقضا" value="<?= Yii::$app->formatter->asDate($model['expire_date'], 'yyyy/MM/dd') ?>" >
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <br>

                        <?php ActiveForm::end() ?>
                    </div>
            </ul>
        </div>

        </div>
        <div class="modal-footer">
                <?= Button::widget([
                    'label' => 'ثبت',
                    'type' => 'primary',
                    'icon' => 'save',
                    'options' => [
                        'id' => 'save_access_modal_btn',
                        'data-form-id' => 'set-users-form',
                        'data-modal-id' => 'access_modal'
                    ]
                ]) ?>

                <?= Button::widget([
                    'label' => 'انصراف',
                    'options' => [
                        'data-dismiss' => 'modal'
                    ],
                    'type' => 'warning',
                    'icon' => 'times'
                ]) ?>
            </div>
        </div>
    </div>
</div>