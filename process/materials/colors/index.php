<?php

use yii\helpers\Url;
use theme\widgets\infoBox\InfoBox;

$this->title = 'رنگ ها';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    $this->title
];

?>

<h1 class="nad-page-title">رنگ ها</h1>
<h2>فعالیت ها:</h2>
<br>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-4" style="text-align: center">
    <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'مطالعات کلی و دستورالعمل ها',
            'titleUrl' => Url::to(['/colors/manage/investigation-design'])
        ]) ?>
    </div>
    <div class="col-md-4" style="text-align: center">
    <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'آزمایشات و نتایج',
            'titleUrl' => '#' // Url::to(['/colors/manage/investigation'])
        ]) ?>
    </div>
    <div class="col-md-2"></div>
</div>
<br>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4" style="text-align: center">
        <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'تامین',
            'titleUrl' => '#'
        ]) ?>
    </div>
    <div class="col-md-4"></div>
</div>
<br>
