<?php

use nad\build\equipment\unit3\investigation2\instruction\models\Category;
use nad\build\equipment\unit3\investigation2\reference\models\Reference;
use nad\build\equipment\unit3\investigation2\proposal\models\Proposal;
use nad\build\equipment\unit3\investigation2\report\models\Report;
use nad\build\equipment\unit3\investigation2\method\models\Method;

$this->title = 'افزودن دستورالعمل';
$this->params['breadcrumbs'] = [
    'احداث',
    'تجهیزات',
    ['label' => 'واحد 3', 'url' => ['/build/equipment/unit3/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/build/equipment/unit3/manage/investigation2']],
    $this->title
];

?>

<div class="instruction-create">
    <?= $this->render('@nad/common/modules/investigation/instruction/views/instruction/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
        'reportConsumerCode' => Report::CONSUMER_CODE,
        'methodConsumerCode' => Method::CONSUMER_CODE,
    ]) ?>
</div>
