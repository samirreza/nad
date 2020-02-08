<?php

use nad\engineering\construction\stage\investigationImprovement\report\models\Category;
use nad\engineering\construction\stage\investigationImprovement\reference\models\Reference;
use nad\engineering\construction\stage\investigationImprovement\proposal\models\Proposal;

$this->title = 'افزودن گزارش';
$this->params['breadcrumbs'] = [
    'فنی',
    'ساختمان',
    ['label' => 'مراحل', 'url' => ['/engineering/construction/stage/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/construction/stage/manage/investigation-improvement']],
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
