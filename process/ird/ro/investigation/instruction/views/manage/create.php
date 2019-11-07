<?php

use nad\process\ird\ro\investigation\instruction\models\Category;
use nad\process\ird\ro\investigation\reference\models\Reference;
use nad\process\ird\ro\investigation\proposal\models\Proposal;
use nad\process\ird\ro\investigation\report\models\Report;
use nad\process\ird\ro\investigation\method\models\Method;

$this->title = 'افزودن دستورالعمل';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'آر او', 'url' => ['/ro/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/ro/manage/investigation']],
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
