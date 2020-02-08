<?php

use nad\engineering\mechanics\stage\investigationImprovement\report\models\Category;
use nad\engineering\mechanics\stage\investigationImprovement\reference\models\Reference;
use nad\engineering\mechanics\stage\investigationImprovement\proposal\models\Proposal;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'مراحل', 'url' => ['/engineering/mechanics/stage/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/mechanics/stage/manage/investigation-improvement']],
    ['label' => 'لیست گزارش', 'url' => ['index']],
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="report-update">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
    ]) ?>
</div>
