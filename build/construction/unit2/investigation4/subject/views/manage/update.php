<?php

use nad\build\construction\unit2\investigation4\reference\models\Reference;
use nad\build\construction\unit2\investigation4\proposal\models\Proposal;
use nad\build\construction\unit2\investigation4\report\models\Report;
use nad\build\construction\unit2\investigation4\method\models\Method;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'احداث',
    'ساختمان',
    ['label' => 'واحد 2', 'url' => ['/build/construction/unit2/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/build/construction/unit2/manage/investigation4']],
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
