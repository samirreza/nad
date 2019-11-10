<?php

use nad\process\ird\graphene\investigation\instruction\models\Category;
use nad\process\ird\graphene\investigation\reference\models\Reference;
use nad\process\ird\graphene\investigation\proposal\models\Proposal;
use nad\process\ird\graphene\investigation\report\models\Report;
use nad\process\ird\graphene\investigation\method\models\Method;

$this->title = 'افزودن دستورالعمل';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'گرافن', 'url' => ['/graphene/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/graphene/manage/investigation']],
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