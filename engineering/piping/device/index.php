<?php

use yii\helpers\Url;
use theme\widgets\infoBox\InfoBox;

$this->title = 'لوله کشی';
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
            'titleUrl' => Url::to(['/engineering/piping/device/manage/investigation-improvement'])
        ]) ?>
    </div>
    <div class="col-md-5" style="text-align: center">
    <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'بررسی روشهای پایش',
            'titleUrl' => Url::to(['/engineering/piping/device/manage/investigation-monitor-methods'])
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
            'titleUrl' => Url::to(['/engineering/piping/device/manage/investigation-design'])
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
                'title' => 'دستگاه ها',
                'titleUrl' => Url::to(['/engineering/piping/device/category/index'])
            ]) ?>
        </div>
        <div class="col-md-5">
            <?= InfoBox::widget([
                'icon' => false,
                'showCount' => false,
                'title' => 'مکان ها',
                'titleUrl' => Url::to(['@web'])
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
                'titleUrl' => Url::to(['@web'])
            ]) ?>
        </div>
        <div class="col-md-5">
            <?= InfoBox::widget([
                'icon' => false,
                'showCount' => false,
                'title' => 'داده های بهره برداری',
                'titleUrl' => Url::to(['@web'])
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
                'titleUrl' => Url::to(['@web'])
            ]) ?>
        </div>
        <div class="col-md-5">
            <?= InfoBox::widget([
                'icon' => false,
                'showCount' => false,
                'title' => 'منابع طراحی',
                'titleUrl' => Url::to(['@web'])
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
                'titleUrl' => Url::to(['@web'])
            ]) ?>
        </div>
        <div class="col-md-5">
            <?= InfoBox::widget([
                'icon' => false,
                'showCount' => false,
                'title' => 'نتایج طراحی ها',
                'titleUrl' => Url::to(['@web'])
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
                'titleUrl' => Url::to(['@web'])
            ]) ?>
        </div>
        <div class="col-md-5">
            <?= InfoBox::widget([
                'icon' => false,
                'showCount' => false,
                'title' => 'روندهای اجرا شده طراحی',
                'titleUrl' => Url::to(['@web'])
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