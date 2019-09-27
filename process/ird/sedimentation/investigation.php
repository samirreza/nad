<?php

use yii\helpers\Url;
use theme\widgets\infoBox\InfoBox;

$this->title = 'بررسی';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'ته نشینی', 'url' => ['/sedimentation/manage/index']],
    $this->title
];

?>

<h2 style="text-align: center">فعالیت ها</h2>
<br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <?= InfoBox::widget([
                'icon' => 'question-circle',
                'showCount' => false,
                'title' => 'منشا',
                'titleUrl' => Url::to(['/sedimentation/investigation/source/manage/index'])
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= InfoBox::widget([
                'icon' => 'graduation-cap',
                'showCount' => false,
                'title' => 'پروپوزال',
                'titleUrl' => Url::to(['/sedimentation/investigation/proposal/manage/index'])
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
                'title' => 'گزارش',
                'titleUrl' => Url::to(['/sedimentation/investigation/report/manage/index'])
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= InfoBox::widget([
                'icon' => 'bell',
                'showCount' => false,
                'title' => 'روش',
                'titleUrl' => Url::to(['/sedimentation/investigation/method/manage/index'])
            ]) ?>
        </div>
        <div class="col-md-3"></div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?= InfoBox::widget([
                'icon' => 'book',
                'showCount' => false,
                'title' => 'دستور العمل',
                'titleUrl' => '#' //Url::to(['/sedimentation/investigation/reference/manage/index'])
            ]) ?>
        </div>
    </div>
    <br><br>

<h2 style="text-align: center">داده گاه ها</h2>
<br>
<div class="row" style="text-align: center">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'منشاها',
            'titleUrl' => Url::to(['/sedimentation/investigation/source/manage/archived-index'])
        ]) ?>
    </div>
    <div class="col-md-4">
        <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'روندهای اجرا شده منشا',
            'titleUrl' => '#'
        ]) ?>
    </div>
</div>
<br><br>
<div class="row" style="text-align: center">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'پروپوزال ها',
            'titleUrl' => '#'
        ]) ?>
    </div>
    <div class="col-md-4">
        <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'روندهای اجرا شده پروپوزال',
            'titleUrl' => '#'
        ]) ?>
    </div>
</div>
<br><br>
<div class="row" style="text-align: center">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'گزارش ها',
            'titleUrl' => '#'
        ]) ?>
    </div>
    <div class="col-md-4">
        <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'روندهای اجرا شده گزارش',
            'titleUrl' => '#'
        ]) ?>
    </div>
</div>
<br><br>
<div class="row" style="text-align: center">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'روش ها',
            'titleUrl' => '#'
        ]) ?>
    </div>
    <div class="col-md-4">
        <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'روندهای اجرا شده روش',
            'titleUrl' => '#'
        ]) ?>
    </div>
</div>
<br><br>
<div class="row" style="text-align: center">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'دستورالعمل ها',
            'titleUrl' => '#'
        ]) ?>
    </div>
    <div class="col-md-4">
        <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'روندهای اجرا شده دستورالعمل',
            'titleUrl' => '#'
        ]) ?>
    </div>
</div>
<br><br>
<div class="row" style="text-align: center">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'منابع',
            'titleUrl' => Url::to(['/sedimentation/investigation/reference/manage/index'])
        ])
        ?>
    </div>
    <div class="col-md-4">
        <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'اقدامات بررسی',
            'titleUrl' => '#'
        ]) ?>
    </div>
</div>
<br><br><br>