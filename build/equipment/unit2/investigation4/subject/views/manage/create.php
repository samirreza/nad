<?php

use nad\build\equipment\unit2\investigation4\reference\models\Reference;
use nad\build\equipment\unit2\investigation4\proposal\models\Proposal;
use nad\build\equipment\unit2\investigation4\report\models\Report;
use nad\build\equipment\unit2\investigation4\method\models\Method;

$this->title = 'افزودن موضوع';
$this->params['breadcrumbs'] = [
    'احداث',
    'تجهیزات',
    ['label' => 'واحد 2', 'url' => ['/build/equipment/unit2/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/build/equipment/unit2/manage/investigation4']],
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
