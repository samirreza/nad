<?php

use yii\bootstrap\Html;

$this->title = 'استخر';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    $this->title
];

?>

<br><br>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        <div class="circle">
            <?= Html::a('بررسی', ['investigation']) ?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="circle">
            <?= Html::a('طراحی', ['/']) ?>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="circle">
            <?= Html::a('پایش', ['/']) ?>
        </div>
    </div>
</div>
