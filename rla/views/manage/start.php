<?php

use yii\helpers\Url;
use theme\widgets\Panel;
use theme\widgets\infoBox\InfoBox;

$this->title = 'دسترسی';
$this->params['breadcrumbs'] = [
    $this->title
];

?>

<h2 class="nad-page-title">دسترسی</h2>
<?php Panel::begin([
                    'title' => 'برنامه ها',
                    'showCollapseButton' => true
                    ]) ?>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <?= InfoBox::widget([
                'icon' => 'list',
                'showCount' => false,
                'title' => 'لیست داده گاه ها',
                'titleUrl' => Url::to(['grant-revoke-preview'])
            ]) ?>
        </div>
        <div class="col-md-3">
            <?= InfoBox::widget([
                'icon' => 'file-text',
                'showCount' => false,
                'title' => 'مدارک',
                'titleUrl' => Url::to(['index'])
            ]) ?>
        </div>
        <div class="col-md-3"></div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
             <?= InfoBox::widget([
                'icon' => 'question',
                'showCount' => false,
                'title' => 'درخواست ها',
                'titleUrl' => Url::to(['/rla/request/index'])
            ]) ?>
        </div>
        <div class="col-md-4"></div>
    </div>
    <br>

<?php Panel::end() ?>
<br><br><br>