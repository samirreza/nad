<?php

use nad\factory\build\unit3\investigation2\reference\models\Reference;
use nad\factory\build\unit3\investigation2\proposal\models\Proposal;
use nad\factory\build\unit3\investigation2\report\models\Report;
use nad\factory\build\unit3\investigation2\method\models\Method;

$this->title = 'افزودن موضوع';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'احداث',
    ['label' => 'واحد 3', 'url' => ['/factory/build/unit3/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/factory/build/unit3/manage/investigation2']],
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
