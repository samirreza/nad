<?php

use nad\seaport\wayside\unit1\investigation1\instruction\models\Category;
use nad\seaport\wayside\unit1\investigation1\reference\models\Reference;
use nad\seaport\wayside\unit1\investigation1\proposal\models\Proposal;
use nad\seaport\wayside\unit1\investigation1\report\models\Report;
use nad\seaport\wayside\unit1\investigation1\method\models\Method;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'بندر',
    'واحد بندر',
    ['label' => 'واحد 1', 'url' => ['/seaport/wayside/unit1/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/seaport/wayside/unit1/manage/investigation1']],
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
