<?php

use nad\engineering\electricity\stage\investigationDesign\instruction\models\Category;
use nad\engineering\electricity\stage\investigationDesign\reference\models\Reference;
use nad\engineering\electricity\stage\investigationDesign\proposal\models\Proposal;
use nad\engineering\electricity\stage\investigationDesign\report\models\Report;
use nad\engineering\electricity\stage\investigationDesign\method\models\Method;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'مراحل', 'url' => ['/engineering/electricity/stage/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/electricity/stage/manage/investigation-design']],
    ['label' => 'لیست دستورالعمل', 'url' => ['index']],
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="instruction-update">
    <?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
        'reportConsumerCode' => Report::CONSUMER_CODE,
        'methodConsumerCode' => Method::CONSUMER_CODE,
    ]) ?>
</div>
