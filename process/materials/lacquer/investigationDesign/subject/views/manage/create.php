<?php

use nad\process\materials\lacquer\investigationDesign\reference\models\Reference;
use nad\process\materials\lacquer\investigationDesign\proposal\models\Proposal;
use nad\process\materials\lacquer\investigationDesign\report\models\Report;
use nad\process\materials\lacquer\investigationDesign\method\models\Method;

$this->title = 'افزودن موضوع';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'لاک بیرنگ', 'url' => ['/lacquer/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/lacquer/manage/investigation-design']],
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
