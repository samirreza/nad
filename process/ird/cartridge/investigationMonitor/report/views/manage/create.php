<?php

use nad\process\ird\cartridge\investigationMonitor\category\models\Category;
use nad\process\ird\cartridge\investigationMonitor\reference\models\Reference;

$this->title = 'افزودن گزارش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'کارتریج', 'url' => ['/cartridge/manage/index']],
    ['label' => 'بررسی', 'url' => ['/cartridge/manage/investigation-monitor']],
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