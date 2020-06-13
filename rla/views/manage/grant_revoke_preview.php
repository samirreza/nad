<?php
use theme\widgets\Panel;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use core\widgets\select2\Select2;
use nad\rla\models\RowLevelAccessPreview;
use yii\helpers\ArrayHelper;

?>

<h3 class="nad-page-title">اعطا/لغو دسترسی پیش نمایش داده گاه ها</h3>
<br>
<div class="rla-grant-revoke-preview">
    <?php $form = ActiveForm::begin([
        'action' => ['grant-revoke-preview'],
        'method' => 'post',
    ]); ?>

        <?php
        $counter = 0;
        foreach ($itemTypes as $key => $value):
        ?>
            <?php Panel::begin([
                    'title' => 'داده گاه ' . $value,
                    'showCollapseButton' => true,
                    'collapsed' => $counter == true,
                    'options' => [
                        'class' => 'panel-primary'
                    ]
                ])
            ?>

            <input type="hidden" id="RowLevelAccessPreview[itemTypes][<?= $counter ?>]" name="RowLevelAccessPreview[itemTypes][<?= $counter ?>]" value="<?= $key ?>">

            <div class="row">
                <div class="col-md-12">
                <div class="form-group">
                <label class="control-label" for="user-surname">لیست کاربران مجاز</label>
                <?= $form->field($modelTemplate, 'userIds')->widget(
                                Select2::class,
                                [
                                    'data' => ArrayHelper::map(
                                        $experts,
                                        'userId',
                                        'user.fullName'
                                    ),
                                    'options' => [
                                        'id' => rand(),
                                        'name' => 'RowLevelAccessPreview[userIds][' . $counter . ']',
                                        'placeholder' => 'کاربران را انتخاب کنید ...',
                                        'multiple' => true,
                                        'value' => ArrayHelper::getColumn(
                                            RowLevelAccessPreview::find()->where(['item_type' => $key])->all(),
                                            'user_id'
                                        )
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ]
                                ]
                            )->label(false) ?>
                </div>
                </div>
            </div>

            <?php Panel::end() ?>
        <?php
        ++$counter;
        endforeach;
        ?>

        <div class="row">
            <div class="col-md-2">
                <br>
                <?= Html::submitButton('ثبت', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>