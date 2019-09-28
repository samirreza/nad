<?php

use yii\helpers\Url;
use theme\widgets\infoBox\InfoBox;

$this->title = 'بررسی';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'فیلتر شنی', 'url' => ['/filter/manage/index']],
    $this->title
];

?>

<br><br>
<div class="well">
    <br><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <?= InfoBox::widget([
                'icon' => 'question-circle',
                'showCount' => false,
                'title' => 'منشا',
                'titleUrl' => Url::to(['/filter/investigation/source/manage/index'])
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= InfoBox::widget([
                'icon' => 'graduation-cap',
                'showCount' => false,
                'title' => 'پروپوزال',
                'titleUrl' => Url::to(['/filter/investigation/proposal/manage/index'])
            ]) ?>
        </div>
        <div class="col-md-3"></div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
             <?= InfoBox::widget([
                'icon' => 'file-text',
                'showCount' => false,
                'title' => 'گزارش‌ها',
                'titleUrl' => Url::to(['/filter/investigation/report/manage/index'])
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= InfoBox::widget([
                'icon' => 'bell',
                'showCount' => false,
                'title' => 'روش‌ها',
                'titleUrl' => Url::to(['/filter/investigation/method/manage/index'])
            ]) ?>
        </div>
        <div class="col-md-3"></div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <?= InfoBox::widget([
                'icon' => 'book',
                'showCount' => false,
                'title' => 'منابع',
                'titleUrl' => Url::to(['/filter/investigation/reference/manage/index'])
            ]) ?>
        </div>
    </div>
    <br><br>
</div>
