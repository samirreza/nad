<?php

use nad\factory\build\unit2\investigation3\reference\models\Reference;
use nad\factory\build\unit2\investigation3\proposal\models\Proposal;
use nad\factory\build\unit2\investigation3\report\models\Report;
use nad\factory\build\unit2\investigation3\method\models\Method;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'احداث',
    ['label' => 'واحد 2', 'url' => ['/factory/build/unit2/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/factory/build/unit2/manage/investigation3']],
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
