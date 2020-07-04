<?php

use nad\process\ird\sedimentation\investigationMonitor\source\models\Source;
use nad\process\ird\sedimentation\investigationMonitor\proposal\models\Category;
use nad\process\ird\sedimentation\investigationMonitor\reference\models\Reference;

$this->title = 'افزودن پروپوزال';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'ته نشینی', 'url' => ['/process/ird/sedimentation/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/process/ird/sedimentation/manage/investigation-monitor']],
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
