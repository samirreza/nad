<?php

use yii\helpers\Url;
use theme\widgets\Panel;
use theme\widgets\infoBox\InfoBox;

$this->title = 'پایش';
$this->params['breadcrumbs'] = [
    'مدیریت',
    ['label' => 'هماهنگی', 'url' => ['/coordination/manage/index']],
    $this->title
];

?>

<h2 class="nad-page-title">پایش</h2>
<?php Panel::begin([
                    'title' => 'برنامه ها',
                    'showCollapseButton' => true
                    ]) ?>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?= InfoBox::widget([
                'icon' => '',
                'showCount' => false,
                'title' => 'انتقال داده',
                'titleUrl' => Url::to(['/coordination/payesh/excelmanager/manage/index'])
            ]) ?>
        </div>
    </div>
    <br>
<?php Panel::end() ?>
<br><br><br>