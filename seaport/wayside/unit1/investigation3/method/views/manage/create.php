<?php

use nad\seaport\wayside\unit1\investigation3\method\models\Category;
use nad\seaport\wayside\unit1\investigation3\reference\models\Reference;
use nad\seaport\wayside\unit1\investigation3\proposal\models\Proposal;
use nad\seaport\wayside\unit1\investigation3\report\models\Report;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'بندر',
    'واحد بندر',
    ['label' => 'واحد 1', 'url' => ['/seaport/wayside/unit1/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/seaport/wayside/unit1/manage/investigation3']],
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
