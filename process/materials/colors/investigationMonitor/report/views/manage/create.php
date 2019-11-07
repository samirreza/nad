<?php

use nad\process\materials\colors\investigationMonitor\category\models\Category;
use nad\process\materials\colors\investigationMonitor\reference\models\Reference;

$this->title = 'افزودن گزارش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'رنگ ها', 'url' => ['/colors/manage/index']],
    ['label' => 'بررسی', 'url' => ['/colors/manage/investigation-monitor']],
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
