<?php

use yii\helpers\Url;
use theme\widgets\infoBox\InfoBox;

$this->title = 'برق';
$this->params['breadcrumbs'] = [
    'فنی',
    $this->title,
    'دستگاه ها'
];

?>

<h2 class="nad-page-title">فعالیت ها  (این صفحه موقت است)</h2>
<br>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-5" style="text-align: center">
    <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'بررسی بهبود',
            'titleUrl' => Url::to(['/engineering/electricity/device/manage/investigation-improvement'])
        ]) ?>
    </div>
    <div class="col-md-5" style="text-align: center">
    <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'بررسی روشهای پایش',
            'titleUrl' => '#' // Url::to(['/engineering/electricity/device/manage/investigation-monitor-methods'])
        ]) ?>
    </div>
</div>
<br><br>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-5" style="text-align: center">
    <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'بررسی طراحی',
            'titleUrl' => '#' // Url::to(['/engineering/electricity/device/manage/investigation-design'])
        ]) ?>
    </div>
</div>
<br><br>

<h2 class="nad-page-title">داده گاه ها (این صفحه موقت است)</h2><br>
    <br>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <?= InfoBox::widget([
                'icon' => false,
                'showCount' => false,
                'title' => 'تجهیزات',
                'titleUrl' => Url::to(['/engineering/electricity/device/device/manage/index'])
            ]) ?>
        </div>
        <div class="col-md-5">
            <?= InfoBox::widget([
                'icon' => false,
                'showCount' => false,
                'title' => 'مکان ها',
                'titleUrl' => '#'
            ]) ?>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <?= InfoBox::widget([
                'icon' => false,
                'showCount' => false,
                'title' => 'مکان های داده برداری',
                'titleUrl' => '#'
            ]) ?>
        </div>
        <div class="col-md-5">
            <?= InfoBox::widget([
                'icon' => false,
                'showCount' => false,
                'title' => 'داده های بهره برداری',
                'titleUrl' => '#'
            ]) ?>
        </div>
    </div>

    <br>
    <br>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <?= InfoBox::widget([
                'icon' => false,
                'showCount' => false,
                'title' => 'منابع پایش',
                'titleUrl' => '#'
            ]) ?>
        </div>
        <div class="col-md-5">
            <?= InfoBox::widget([
                'icon' => false,
                'showCount' => false,
                'title' => 'منابع طراحی',
                'titleUrl' => '#'
            ]) ?>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <?= InfoBox::widget([
                'icon' => false,
                'showCount' => false,
                'title' => 'نتایج پایش ها',
                'titleUrl' => '#'
            ]) ?>
        </div>
        <div class="col-md-5">
            <?= InfoBox::widget([
                'icon' => false,
                'showCount' => false,
                'title' => 'نتایج طراحی ها',
                'titleUrl' => '#'
            ]) ?>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <?= InfoBox::widget([
                'icon' => false,
                'showCount' => false,
                'title' => 'روندهای اجرا شده پایش',
                'titleUrl' => '#'
            ]) ?>
        </div>
        <div class="col-md-5">
            <?= InfoBox::widget([
                'icon' => false,
                'showCount' => false,
                'title' => 'روندهای اجرا شده طراحی',
                'titleUrl' => '#'
            ]) ?>
        </div>
    </div>
    <br><br>
</div>

<?php
$this->registerCss('
div.row div.col-md-5{
    text-align:center;
}
');
?>