<?php

use nad\process\ird\graphene\investigationMonitor\method\models\Category;
use nad\process\ird\graphene\investigationMonitor\reference\models\Reference;
use nad\process\ird\graphene\investigationMonitor\proposal\models\Proposal;
use nad\process\ird\graphene\investigationMonitor\report\models\Report;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'گرافن', 'url' => ['/process/ird/graphene/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/process/ird/graphene/manage/investigation-monitor']],
    ['label' => 'لیست روش', 'url' => ['index']],
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="method-update">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
        'reportConsumerCode' => Report::CONSUMER_CODE,
    ]) ?>
</div>
