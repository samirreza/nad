<?php

use nad\process\ird\ro\investigationMonitor\reference\models\Reference;

$this->title = 'افزودن پروپوزال';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'آر او', 'url' => ['/ro/manage/index']],
    ['label' => 'بررسی', 'url' => ['/ro/manage/investigation-monitor']],
    $this->title
];

?>

<div class="proposal-create">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE
    ]) ?>
</div>
