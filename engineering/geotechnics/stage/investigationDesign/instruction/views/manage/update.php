<?php

use nad\engineering\geotechnics\stage\investigationDesign\instruction\models\Category;
use nad\engineering\geotechnics\stage\investigationDesign\reference\models\Reference;
use nad\engineering\geotechnics\stage\investigationDesign\proposal\models\Proposal;
use nad\engineering\geotechnics\stage\investigationDesign\report\models\Report;
use nad\engineering\geotechnics\stage\investigationDesign\method\models\Method;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'مراحل', 'url' => ['/engineering/geotechnics/stage/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/geotechnics/stage/manage/investigation-design']],
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
