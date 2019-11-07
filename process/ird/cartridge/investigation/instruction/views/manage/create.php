<?php

use nad\process\ird\cartridge\investigation\instruction\models\Category;
use nad\process\ird\cartridge\investigation\reference\models\Reference;
use nad\process\ird\cartridge\investigation\proposal\models\Proposal;
use nad\process\ird\cartridge\investigation\report\models\Report;
use nad\process\ird\cartridge\investigation\method\models\Method;

$this->title = 'افزودن دستورالعمل';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'کارتریج', 'url' => ['/cartridge/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/cartridge/manage/investigation']],
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
