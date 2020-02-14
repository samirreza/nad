<?php

use nad\temporary\financial\unit1\investigation4\reference\models\Reference;
use nad\temporary\financial\unit1\investigation4\proposal\models\Proposal;
use nad\temporary\financial\unit1\investigation4\report\models\Report;
use nad\temporary\financial\unit1\investigation4\method\models\Method;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'موقت',
    'مالی',
    ['label' => 'واحد 1', 'url' => ['/temporary/financial/unit1/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/temporary/financial/unit1/manage/investigation4']],
    ['label' => 'لیست موضوع های فعال', 'url' => ['index']],
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="subject-update">
    <?= $this->render('@nad/common/modules/investigation/subject/views/subject/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
        'reportConsumerCode' => Report::CONSUMER_CODE,
        'methodConsumerCode' => Method::CONSUMER_CODE,
    ]) ?>
</div>
