<?php

use yii\bootstrap\Html;

$this->title = 'بررسی';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'استخر', 'url' => ['/pool/manage/index']],
    $this->title
];

?>

<br><br>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        <div class="circle">
            <?= Html::a('منشا', ['/pool/investigation/source']) ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="circle">
            <?= Html::a('پروپوزال', ['/pool/investigation/proposal/manage/index']) ?>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        <div class="circle">
            <?= Html::a('گزارش‌ها', ['/pool/investigation/report/manage/index']) ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="circle">
            <?= Html::a('روش‌ها', ['/']) ?>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="circle">
            <?= Html::a('منابع', ['/pool/investigation/reference/manage/index']) ?>
        </div>
    </div>
</div>
