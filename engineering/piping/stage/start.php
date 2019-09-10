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
    <br><h1 style="text-align: center">فعالیت ها</h1><br>
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
    </div>
    <br><br>

    <br><h1 style="text-align: center">داده گاه ها</h1><br>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <?= InfoBox::widget([  
                'icon' => false,              
                'showCount' => false,
                'title' => 'مراحل',
                'titleUrl' => Url::to(['/engineering/piping/stage/manage/index'])
            ]) ?>
        </div>
        <div class="col-md-3">
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
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <?= InfoBox::widget([   
                'icon' => false,             
                'showCount' => false,
                'title' => 'منابع پایش',
                'titleUrl' => Url::to(['@web'])
            ]) ?>
        </div>
        <div class="col-md-3">
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
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <?= InfoBox::widget([     
                'icon' => false,           
                'showCount' => false,
                'title' => 'مکان های داده برداری',
                'titleUrl' => Url::to(['@web'])
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= InfoBox::widget([   
                'icon' => false,             
                'showCount' => false,
                'title' => 'داده های بهره برداری',
                'titleUrl' => Url::to(['@web'])
            ]) ?>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <?= InfoBox::widget([ 
                'icon' => false,               
                'showCount' => false,
                'title' => 'نتایج پایش ها',
                'titleUrl' => Url::to(['@web'])
            ]) ?>
        </div>
        <div class="col-md-3">
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
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <?= InfoBox::widget([  
                'icon' => false,              
                'showCount' => false,
                'title' => 'روندهای اجرا شده پایش',
                'titleUrl' => Url::to(['@web'])
            ]) ?>
        </div>
        <div class="col-md-3">
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
