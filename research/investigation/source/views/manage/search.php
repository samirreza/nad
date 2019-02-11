<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use yii\bootstrap\ActiveForm;
use extensions\tag\widgets\selectTag\SelectTag;

$this->title = 'جست‌و‌جو منشا';
$this->params['breadcrumbs'] = [
    'پژوهش',
    'بررسی',
    $this->title
];

?>

<br><br>
<div class="row">
    <div class="col-md-5 col-md-offset-3">
        <?php $form = ActiveForm::begin() ?>
            <?php Panel::begin(['title' => 'جست‌و‌جو منشا']) ?>
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'title')->textInput([
                            'maxlength' => 255,
                            'class' => 'form-control input-xlarge'
                        ]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'tags')->widget(
                            SelectTag::class,
                            [
                                'options' => [
                                    'class' => 'form-control input-xlarge'
                                ]
                            ]
                        ) ?>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <?= Html::submitButton(
                            '<i class="fa fa-search"></i> لیست',
                            ['class' => 'btn btn-success pull-left']
                        ) ?>
                    </div>
                </div>
            <?php Panel::end() ?>
        <?php ActiveForm::end() ?>
    </div>
</div>
