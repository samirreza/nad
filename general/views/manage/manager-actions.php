<?php

use yii\helpers\Url;
use theme\widgets\infoBox\InfoBox;

$this->title = 'مدیریت';
$this->params['breadcrumbs'] = [
    $this->title
];

?>

<h1 class="nad-page-title"><?= $this->title ?></h1>
<h2>فعالیت ها:</h2>
<br>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-3" style="text-align: center">
    <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'کاربران',
            'titleUrl' => Url::to(['/user/manage/index'])
        ]) ?>
    </div>
    <div class="col-md-3" style="text-align: center">
        <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'دسترسی',
            'titleUrl' => Url::to(['/rla/manage/start'])
        ]) ?>
    </div>
    <div class="col-md-3"></div>
</div>
<br>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4" style="text-align: center">
    <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'تنظیمات سیستم',
            'titleUrl' => Url::to(['/setting/manage/index']),
        ]) ?>
    </div>
    <div class="col-md-4"></div>
</div>
<br>
