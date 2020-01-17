<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\Button;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use core\widgets\editor\Editor;
use theme\widgets\ActionButtons;
use core\widgets\select2\Select2;
use extensions\tag\widgets\selectTag\SelectTag;
use theme\widgets\jalalidatepicker\JalaliDatePicker;
use extensions\file\widgets\singleupload\SingleFileUpload;
use nad\common\modules\investigation\subject\models\Category;
use nad\common\modules\investigation\subject\models\SubjectReason;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];
$className = get_class($model);
$uploadedFiles = $model->getFiles('file');
?>

<h2 class="nad-page-title"><?= $this->title ?></h2>

<?= ActionButtons::widget([
    'buttons' => [
        'create-category' => [
            'label' => 'افزودن رده',
            'type' => 'info',
            'icon' => 'plus',
            'url' => [
                'category/index#id_createCategoryBtn'
            ],
            'options' => [
                'target' => '_blank'
            ]
        ]
    ]
]);
?>

<div class="subject-form">
    <?php Panel::begin(['title' => 'مشخصات موضوع']) ?>
        <?php $form = ActiveForm::begin(
            ['options' => ['enctype' => 'multipart/form-data']]
        ) ?>
            <div class="row">
                <div class="col-md-8">
                    <?= $form->field($model, 'title')->textInput([
                        'maxlength' => 255,
                        'class' => 'form-control input-large'
                    ]) ?>
                    <?= $form->field($model, 'englishTitle')->textInput([
                        'maxlength' => 255,
                        'class' => 'form-control input-large'
                    ]) ?>
                    <?= $form->field($model, 'createdAt')->widget(
                        JalaliDatePicker::class,
                        [
                            'options' => [
                                'class' => 'form-control input-small',
                                'autocomplete' => 'off'
                            ]
                        ]
                    ) ?>
                    <div class="row">
                        <div class="col-md-8">
                            <?php
                            if(isset($uploadedFiles) && !empty($uploadedFiles)){
                                Panel::begin();
                            ?>
                                    <label>فایل موضوع</label>
                                    <?= SingleFileUpload::widget([
                                        'model' => $model,
                                        'group' => 'file',
                                    ]) ?>
                            <?php
                                Panel::end();
                            }
                            ?>
                            <?php Panel::begin() ?>
                                <label>فایل موضوع</label>
                                <?= SingleFileUpload::widget([
                                    'model' => new $className,
                                    'group' => 'file',
                                ]) ?>
                            <?php Panel::end() ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-sm-12">
                        <?= Html::submitButton('ذخیره', [
                            'class' => 'btn btn-xs btn-warning action-button'
                        ]) ?>
                        <?= Button::widget([
                            'label' => 'انصراف',
                            'type' => 'warning',
                            'icon' => false,
                            'url' => $backLink
                        ]) ?>
                    </div>
                    <br><br>
                    <?= $form->field($model, 'categoryId')->widget(
                        Select2::class,
                        [
                            'data' => ArrayHelper::map(
                                Category::find()->andWhere([
                                    'depth' => 3,
                                    'consumer' => $categoryConsumerCode
                                ])->all(),
                                'id',
                                'codedTitle'
                            )
                        ]
                    ) ?>
                    <?= $form->field($model, 'tags')->widget(SelectTag::class) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'text')->widget(
                        Editor::class,
                        ['preset' => 'advanced']
                    ) ?>
                    <?= $form->field($model, 'description')->widget(
                        Editor::class,
                        ['preset' => 'advanced']
                    ) ?>
                </div>
            </div>
        <?php ActiveForm::end() ?>
    <?php Panel::end() ?>
</div>
