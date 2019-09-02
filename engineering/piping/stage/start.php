<?php

use yii\helpers\Url;
use theme\widgets\infoBox\InfoBox;

$this->title = 'لوله کشی';
$this->params['breadcrumbs'] = [
    'فنی',
    $this->title,
    'مراحل'      
];

?>

<br><br><br><br>
<div class="well">
    <br><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <?= InfoBox::widget([
                'icon' => 'search',
                'showCount' => false,
                'title' => 'بررسی',
                'titleUrl' => Url::to(['/engineering/piping/stage/manage/investigation'])
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= InfoBox::widget([
                'icon' => 'pencil',
                'showCount' => false,
                'title' => 'طراحی',
                'titleUrl' => Url::to('@web')
            ]) ?>
        </div>
        <div class="col-md-3"></div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <?= InfoBox::widget([
                'icon' => 'retweet',
                'showCount' => false,
                'title' => 'پایش',
                'titleUrl' => Url::to('@web')
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= InfoBox::widget([
                'icon' => 'list-ol',
                'showCount' => false,
                'title' => 'مراحل و<br/> بسته مدارک',
                'titleUrl' => Url::to(['/engineering/piping/stage/manage/index'])
            ]) ?>
        </div>
    </div>
    <br><br>
</div>
