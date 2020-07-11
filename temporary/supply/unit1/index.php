<?php

use yii\helpers\Url;
use theme\widgets\infoBox\InfoBox;

$this->title = 'تامین';
$this->params['breadcrumbs'] = [
    'موقت',
    $this->title,
    'واحد 1'
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
            'title' => 'فعالیت الف',
            'titleUrl' => Url::to(['/temporary/supply/unit1/manage/investigation1'])
        ]) ?>
    </div>
    <div class="col-md-5" style="text-align: center">
    <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'فعالیت ب',
            'titleUrl' => Url::to(['/temporary/supply/unit1/manage/investigation2'])
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
            'title' => 'فعالیت ج',
            'titleUrl' => Url::to(['/temporary/supply/unit1/manage/investigation3'])
        ]) ?>
    </div>
    <div class="col-md-5" style="text-align: center">
    <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'فعالیت د',
            'titleUrl' => Url::to(['/temporary/supply/unit1/manage/investigation4'])
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
            'title' => 'فعالیت ه',
            'titleUrl' => Url::to(['/temporary/supply/unit1/manage/investigation5'])
        ]) ?>
    </div>
    <div class="col-md-5" style="text-align: center">
    <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'فایلهای اکسل',
            'titleUrl' => Url::to(['/temporary/supply/unit1/excelmanager/manage/index'])
        ]) ?>
    </div>
</div>
<br><br>
<br><br>

<?php
$this->registerCss('
div.row div.col-md-5{
    text-align:center;
}
');
?>