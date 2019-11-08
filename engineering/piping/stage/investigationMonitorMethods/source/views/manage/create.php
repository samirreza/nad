<?php

use nad\engineering\piping\stage\investigationMonitorMethods\source\models\Category;
use nad\engineering\piping\stage\investigationMonitorMethods\reference\models\Reference;

$this->title = 'افزودن منشا';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/piping/stage/manage/investigation-monitor-methods']],
    'برنامه منشا',
    $this->title
];

?>

<div class="source-create">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
    ]) ?>
</div>
