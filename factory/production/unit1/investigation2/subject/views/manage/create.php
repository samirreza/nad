<?php

use nad\factory\production\unit1\investigation2\reference\models\Reference;
use nad\factory\production\unit1\investigation2\proposal\models\Proposal;
use nad\factory\production\unit1\investigation2\report\models\Report;
use nad\factory\production\unit1\investigation2\method\models\Method;

$this->title = 'افزودن موضوع';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'واحد 1', 'url' => ['/factory/production/unit1/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/factory/production/unit1/manage/investigation2']],
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
