<?php

use nad\process\materials\antisediment\investigationDesign\instruction\models\Category;
use nad\process\materials\antisediment\investigationDesign\reference\models\Reference;
use nad\process\materials\antisediment\investigationDesign\proposal\models\Proposal;
use nad\process\materials\antisediment\investigationDesign\report\models\Report;
use nad\process\materials\antisediment\investigationDesign\method\models\Method;

$this->title = 'افزودن دستورالعمل';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'ضدرسوب', 'url' => ['/antisediment/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/antisediment/manage/investigation-design']],
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
