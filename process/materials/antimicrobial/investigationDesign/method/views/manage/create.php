<?php

use nad\process\materials\antimicrobial\investigationDesign\method\models\Category;
use nad\process\materials\antimicrobial\investigationDesign\reference\models\Reference;
use nad\process\materials\antimicrobial\investigationDesign\proposal\models\Proposal;
use nad\process\materials\antimicrobial\investigationDesign\report\models\Report;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'ضدمیکروب', 'url' => ['/antimicrobial/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/antimicrobial/manage/investigation-design']],
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
