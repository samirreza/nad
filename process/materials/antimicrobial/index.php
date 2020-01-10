<?php

use yii\helpers\Url;
use theme\widgets\infoBox\InfoBox;

$this->title = 'ضدمیکروب';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    $this->title
];

?>

<h1 class="nad-page-title">ضدمیکروب</h1>
<h2>فعالیت ها:</h2>
<br>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-3" style="text-align: center">
    <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'بررسی فرایندی',
            'titleUrl' => '#' // Url::to(['/antimicrobial/manage/investigation'])
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
            'titleUrl' => '#'//Url::to(['/antimicrobial/manage/investigation-monitor'])
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
            'title' => 'مطالعات کلی و دستورالعمل ها',
            'titleUrl' => Url::to(['/antimicrobial/manage/investigation-design'])
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
