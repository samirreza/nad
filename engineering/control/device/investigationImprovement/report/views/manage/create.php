<?php

use nad\engineering\control\device\investigationImprovement\report\models\Category;
use nad\engineering\control\device\investigationImprovement\reference\models\Reference;
use nad\engineering\control\device\investigationImprovement\proposal\models\Proposal;

$this->title = 'افزودن گزارش';
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/control/device/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/control/device/manage/investigation-improvement']],
    $this->title
];

?>

<div class="report-create">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
    ]) ?>
</div>