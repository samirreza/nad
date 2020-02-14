<?php

use nad\temporary\informationtech\unit2\investigation1\method\models\Category;
use nad\temporary\informationtech\unit2\investigation1\reference\models\Reference;
use nad\temporary\informationtech\unit2\investigation1\proposal\models\Proposal;
use nad\temporary\informationtech\unit2\investigation1\report\models\Report;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'موقت',
    'آی تی',
    ['label' => 'واحد 2', 'url' => ['/temporary/informationtech/unit2/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/temporary/informationtech/unit2/manage/investigation1']],
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
