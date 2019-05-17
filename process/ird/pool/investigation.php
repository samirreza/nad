<?php

use yii\bootstrap\Html;

$this->title = 'بررسی';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    'استخر',
    $this->title
];
$this->params['disableHorizontalMenu'] = true;

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
            <?= Html::a('پروپوزال', ['/']) ?>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        <div class="circle">
            <?= Html::a('گزارش‌ها', ['/']) ?>
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
            <?= Html::a('منابع', ['/']) ?>
        </div>
    </div>
</div>
