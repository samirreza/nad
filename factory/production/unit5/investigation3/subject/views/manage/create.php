<?php

use nad\factory\production\unit5\investigation3\reference\models\Reference;
use nad\factory\production\unit5\investigation3\proposal\models\Proposal;
use nad\factory\production\unit5\investigation3\report\models\Report;
use nad\factory\production\unit5\investigation3\method\models\Method;

$this->title = 'افزودن موضوع';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'انبار', 'url' => ['/factory/production/unit5/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/factory/production/unit5/manage/investigation3']],
    $this->title
];

?>

<div class="subject-create">
    <?= $this->render('@nad/common/modules/investigation/subject/views/subject/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
        'reportConsumerCode' => Report::CONSUMER_CODE,
        'methodConsumerCode' => Method::CONSUMER_CODE,
    ]) ?>
</div>
