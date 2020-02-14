<?php

use nad\seaport\wayside\unit3\investigation5\method\models\Category;
use nad\seaport\wayside\unit3\investigation5\reference\models\Reference;
use nad\seaport\wayside\unit3\investigation5\proposal\models\Proposal;
use nad\seaport\wayside\unit3\investigation5\report\models\Report;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'بندر',
    'واحد بندر',
    ['label' => 'واحد 3', 'url' => ['/seaport/wayside/unit3/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/seaport/wayside/unit3/manage/investigation5']],
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
