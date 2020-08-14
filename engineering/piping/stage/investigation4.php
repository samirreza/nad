<?php

use yii\helpers\Url;
use theme\widgets\Panel;
use theme\widgets\infoBox\InfoBox;

$this->title = 'کنترل کیفیت';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage']],
    $this->title
];

?>

<h2 class="nad-page-title">کنترل کیفیت</h2>
<?php Panel::begin([
                    'title' => 'برنامه ها',
                    'showCollapseButton' => true
                    ]) ?>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6" style="text-align: center">
            <?= InfoBox::widget([
                'icon' => '-',
                'showCount' => false,
                'title' => 'سایرگزارشها',
                'titleUrl' => Url::to(['/engineering/piping/stage/investigation4/subject/manage/index'])
            ]) ?>
        </div>
    </div>
    <?php Panel::end() ?>
    <?php Panel::begin([
                    'title' => 'داده گاه ها',
                    'showCollapseButton' => true
                    ]) ?>
<div class="row" style="text-align: center">
    <div class="col-md-1"></div>
    <div class="col-md-5">
        <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'سایرگزاشها',
            'titleUrl' => Url::to(['/engineering/piping/stage/investigation4/subject/manage/archived-index'])
        ]) ?>
    </div>
    <div class="col-md-5">
        <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'منابع',
            'titleUrl' => Url::to(['/engineering/piping/stage/investigation4/reference/manage/index'])
        ])
        ?>
    </div>
</div>
<?php Panel::end() ?>
<br><br><br>