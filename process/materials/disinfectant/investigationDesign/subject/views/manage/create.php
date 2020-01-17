<?php

use nad\process\materials\disinfectant\investigationDesign\subject\models\Category;
use nad\process\materials\disinfectant\investigationDesign\reference\models\Reference;
use nad\process\materials\disinfectant\investigationDesign\proposal\models\Proposal;
use nad\process\materials\disinfectant\investigationDesign\report\models\Report;
use nad\process\materials\disinfectant\investigationDesign\method\models\Method;

$this->title = 'افزودن موضوع';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/process/materials/disinfectant/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/process/materials/disinfectant/manage/investigation-design']],
    $this->title
];

?>

<div class="subject-create">
    <?= $this->render('@nad/common/modules/investigation/subject/views/subject/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
        'reportConsumerCode' => Report::CONSUMER_CODE,
        'methodConsumerCode' => Method::CONSUMER_CODE,
    ]) ?>
</div>
