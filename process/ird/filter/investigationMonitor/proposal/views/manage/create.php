<?php

use nad\process\ird\filter\investigationMonitor\source\models\Source;
use nad\process\ird\filter\investigationMonitor\proposal\models\Category;
use nad\process\ird\filter\investigationMonitor\reference\models\Reference;

$this->title = 'افزودن پروپوزال';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'فیلترشنی', 'url' => ['/process/ird/filter/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/process/ird/filter/manage/investigation-monitor']],
    $this->title
];

?>

<div class="proposal-create">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'sourceConsumerCode' => Source::CONSUMER_CODE
    ]) ?>
</div>
