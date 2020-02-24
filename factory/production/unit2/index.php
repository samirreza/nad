<?php

use yii\helpers\Url;
use theme\widgets\infoBox\InfoBox;

$this->title = 'تولید';
$this->params['breadcrumbs'] = [
    'کارخانه',
    $this->title,
    'آزمایشگاه'
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
            'titleUrl' => Url::to(['/factory/production/unit2/manage/investigation1'])
        ]) ?>
    </div>
    <div class="col-md-5" style="text-align: center">
    <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'فعالیت ب',
            'titleUrl' => Url::to(['/factory/production/unit2/manage/investigation2'])
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
            'titleUrl' => Url::to(['/factory/production/unit2/manage/investigation3'])
        ]) ?>
    </div>
    <div class="col-md-5" style="text-align: center">
    <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'فعالیت د',
            'titleUrl' => Url::to(['/factory/production/unit2/manage/investigation4'])
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
            'titleUrl' => Url::to(['/factory/production/unit2/manage/investigation5'])
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