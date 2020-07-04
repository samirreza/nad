<?php

use nad\process\ird\graphene\investigationMonitor\instruction\models\Category;
use nad\process\ird\graphene\investigationMonitor\reference\models\Reference;
use nad\process\ird\graphene\investigationMonitor\proposal\models\Proposal;
use nad\process\ird\graphene\investigationMonitor\report\models\Report;
use nad\process\ird\graphene\investigationMonitor\method\models\Method;

$this->title = 'افزودن دستورالعمل';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'گرافن', 'url' => ['/process/ird/graphene/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/process/ird/graphene/manage/investigation-monitor']],
    $this->title
];

?>

<div class="instruction-create">
    <?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
        'reportConsumerCode' => Report::CONSUMER_CODE,
        'methodConsumerCode' => Method::CONSUMER_CODE,
    ]) ?>
</div>
