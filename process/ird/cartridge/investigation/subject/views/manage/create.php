<?php

use nad\process\ird\cartridge\investigation\reference\models\Reference;
use nad\process\ird\cartridge\investigation\proposal\models\Proposal;
use nad\process\ird\cartridge\investigation\report\models\Report;
use nad\process\ird\cartridge\investigation\method\models\Method;

$this->title = 'افزودن موضوع';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'کارتریج', 'url' => ['/cartridge/manage/index']],
    ['label' => 'سایرگزارشها', 'url' => ['/cartridge/manage/investigation']],
    $this->title
];

?>

<div class="subject-create">
    <?= $this->render('@nad/common/modules/investigation/subject/views/subject/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
        'reportConsumerCode' => Report::CONSUMER_CODE,
        'methodConsumerCode' => Method::CONSUMER_CODE,
    ]) ?>
</div>
