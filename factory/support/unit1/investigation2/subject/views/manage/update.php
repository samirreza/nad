<?php

use nad\factory\support\unit1\investigation2\reference\models\Reference;
use nad\factory\support\unit1\investigation2\proposal\models\Proposal;
use nad\factory\support\unit1\investigation2\report\models\Report;
use nad\factory\support\unit1\investigation2\method\models\Method;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'پشتیبانی',
    ['label' => 'واحد 1', 'url' => ['/factory/support/unit1/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/factory/support/unit1/manage/investigation2']],
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
