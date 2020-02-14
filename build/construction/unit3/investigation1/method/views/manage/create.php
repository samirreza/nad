<?php

use nad\build\construction\unit3\investigation1\method\models\Category;
use nad\build\construction\unit3\investigation1\reference\models\Reference;
use nad\build\construction\unit3\investigation1\proposal\models\Proposal;
use nad\build\construction\unit3\investigation1\report\models\Report;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'احداث',
    'ساختمان',
    ['label' => 'واحد 3', 'url' => ['/build/construction/unit3/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/build/construction/unit3/manage/investigation1']],
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
