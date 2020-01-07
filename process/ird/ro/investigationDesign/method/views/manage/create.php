<?php

use nad\process\ird\ro\investigationDesign\method\models\Category;
use nad\process\ird\ro\investigationDesign\reference\models\Reference;
use nad\process\ird\ro\investigationDesign\proposal\models\Proposal;
use nad\process\ird\ro\investigationDesign\report\models\Report;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'آر او', 'url' => ['/ro/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/ro/manage/investigation-design']],
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
