<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use core\widgets\editor\Editor;
use core\widgets\select2\Select2;
use extensions\tag\widgets\selectTag\SelectTag;
use nad\research\modules\project\models\Category;
use extensions\file\widgets\singleupload\SingleFileUpload;
use nad\research\modules\resource\widgets\SelectResource\SelectResource;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];

?>

<div class="project-form">
    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]) ?>
        <div class="row">
            <div class="col-md-8">
            <?php Panel::begin(['title' => 'مشخصات گزارش']) ?>
                    <?= $form->field($model, 'title')->textInput([
                        'maxlength' => 255,
                        'class' => 'form-control input-large'
                    ]) ?>
                    <br>
                    <div class="input-small">
                        <?= SingleFileUpload::widget([
                            'model' => $model,
                            'group' => 'report'
                        ]) ?>
                    </div>
                    <br>
                    <?= $form->field($model, 'abstract')->widget(
                        Editor::class,
                        ['preset' => 'advanced']
                    ) ?>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-4">
                <?php Panel::begin(['title' => 'سایر اطلاعات گزارش']) ?>
                    <?= $form->field($model, 'categoryId')->widget(
                        Select2::class,
                        [
                            'data' => ArrayHelper::map(
                                Category::find()->where(['depth' => 3])->all(),
                                'id',
                                'codedTitle'
                            )
                        ]
                    ) ?>
                    <?= $form->field($model, 'resources')->widget(SelectResource::class) ?>
                    <?= $form->field($model, 'tags')->widget(SelectTag::class) ?>
                <?php Panel::end() ?>
                <?php Panel::begin() ?>
                    <?= Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        [
                            'class' => 'btn btn-lg btn-success'
                        ]
                    ) ?>
                    <?= Button::widget([
                        'label' => 'انصراف',
                        'options' => ['class' => 'btn-lg'],
                        'type' => 'warning',
                        'icon' => 'undo',
                        'url' => $backLink
                    ]) ?>
                <?php Panel::end() ?>
            </div>
        </div>
    <?php ActiveForm::end() ?>
</div>
