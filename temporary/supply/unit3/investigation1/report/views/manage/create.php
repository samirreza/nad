<?php

use nad\temporary\supply\unit3\investigation1\report\models\Category;
use nad\temporary\supply\unit3\investigation1\reference\models\Reference;
use nad\temporary\supply\unit3\investigation1\proposal\models\Proposal;

$this->title = 'افزودن گزارش';
$this->params['breadcrumbs'] = [
    'موقت',
    'تامین',
    ['label' => 'واحد 3', 'url' => ['/temporary/supply/unit3/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/temporary/supply/unit3/manage/investigation1']],
    $this->title
];

?>

<div class="report-create">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
    ]) ?>
</div>
