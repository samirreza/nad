<?php

use nad\seaport\wayside\unit3\investigation3\reference\models\Reference;
use nad\seaport\wayside\unit3\investigation3\proposal\models\Proposal;
use nad\seaport\wayside\unit3\investigation3\report\models\Report;
use nad\seaport\wayside\unit3\investigation3\method\models\Method;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'بندر',
    'واحد بندر',
    ['label' => 'واحد 3', 'url' => ['/seaport/wayside/unit3/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/seaport/wayside/unit3/manage/investigation3']],
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
