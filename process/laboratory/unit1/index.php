<?php

use yii\helpers\Url;
use theme\widgets\infoBox\InfoBox;

$this->title = 'آزمایشگاه';
$this->params['breadcrumbs'] = [
    'فرایند',
    $this->title,
    'آزمایش های بهره برداری'
];

?>

<h2 class="nad-page-title">فعالیت ها  (این صفحه موقت است)</h2>
<br>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4" style="text-align: center">
    <?= InfoBox::widget([
            'icon' => false,
            'showCount' => false,
            'title' => 'فعالیت بررسی',
            'titleUrl' => Url::to(['/process/laboratory/unit1/manage/investigation1'])
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