<?php

use nad\engineering\geotechnics\stage\investigationDesign\method\models\Category;
use nad\engineering\geotechnics\stage\investigationDesign\reference\models\Reference;
use nad\engineering\geotechnics\stage\investigationDesign\proposal\models\Proposal;
use nad\engineering\geotechnics\stage\investigationDesign\report\models\Report;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'مراحل', 'url' => ['/engineering/geotechnics/stage/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/geotechnics/stage/manage/investigation-design']],
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
