<?php

use nad\process\materials\coagulant\investigationMonitor\category\models\Category;
use nad\process\materials\coagulant\investigationMonitor\reference\models\Reference;

$this->title = 'افزودن گزارش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'منعقدکننده', 'url' => ['/process/materials/coagulant/manage/index']],
    ['label' => 'بررسی', 'url' => ['/process/materials/coagulant/manage/investigation-monitor']],
    $this->title
];

?>

<div class="report-create">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
    ]) ?>
</div>
