<?php

use yii\helpers\Url;
use theme\widgets\infoBox\InfoBox;

$this->title = 'هماهنگی';
$this->params['breadcrumbs'] = [
    'مدیریت',
    $this->title
];

?>

<h1 class="nad-page-title">هماهنگی</h1>
<h2>فعالیت ها:</h2>
<br>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4" style="text-align: center">
    <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'پایش',
            'titleUrl' => Url::to(['/coordination/manage/payesh'])
        ]) ?>
    </div>
</div>
<br>
