<?php

use yii\helpers\Url;
use theme\widgets\infoBox\InfoBox;

$this->title = 'ضدرسوب';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    $this->title
];

?>

<h1 class="nad-page-title">ضدرسوب</h1>
<h2>فعالیت ها:</h2>
<br>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-3" style="text-align: center">
    <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'بررسی فرایندی',
            'titleUrl' => '#' // Url::to(['/antisediment/manage/investigation'])
        ]) ?>
    </div>
    <div class="col-md-3" style="text-align: center">
        <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'تامین',
            'titleUrl' => '#'
        ]) ?>
    </div>
    <div class="col-md-3"></div>
</div>
<br>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-3" style="text-align: center">
    <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'بررسی پایش',
            'titleUrl' => '#'//Url::to(['/antisediment/manage/investigation-monitor'])
        ]) ?>
    </div>
    <div class="col-md-3" style="text-align: center">
        <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'پایش',
            'titleUrl' => '#'
        ]) ?>
    </div>
    <div class="col-md-3"></div>
</div>
<br>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-3" style="text-align: center">
    <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'بررسی طراحی',
            'titleUrl' => Url::to(['/antisediment/manage/investigation-design'])
        ]) ?>
    </div>
    <div class="col-md-3" style="text-align: center">
        <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'طراحی',
            'titleUrl' => '#'
        ]) ?>
    </div>
    <div class="col-md-3"></div>
</div>