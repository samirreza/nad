<?php

use nad\build\equipment\unit1\investigation1\method\models\Category;
use nad\build\equipment\unit1\investigation1\reference\models\Reference;
use nad\build\equipment\unit1\investigation1\proposal\models\Proposal;
use nad\build\equipment\unit1\investigation1\report\models\Report;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'احداث',
    'تجهیزات',
    ['label' => 'واحد 1', 'url' => ['/build/equipment/unit1/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/build/equipment/unit1/manage/investigation1']],
    $this->title
];

?>

<div class="method-create">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
        'reportConsumerCode' => Report::CONSUMER_CODE,
    ]) ?>
</div>
