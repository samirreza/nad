<?php

use nad\process\materials\lacquer\investigationDesign\method\models\Category;
use nad\process\materials\lacquer\investigationDesign\reference\models\Reference;
use nad\process\materials\lacquer\investigationDesign\proposal\models\Proposal;
use nad\process\materials\lacquer\investigationDesign\report\models\Report;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'لاک بیرنگ', 'url' => ['/lacquer/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/lacquer/manage/investigation-design']],
    ['label' => 'لیست روش', 'url' => ['index']],
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="method-update">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
        'reportConsumerCode' => Report::CONSUMER_CODE,
    ]) ?>
</div>
