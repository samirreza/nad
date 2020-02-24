<?php

use nad\process\materials\coagulant\investigationDesign\reference\models\Reference;
use nad\process\materials\coagulant\investigationDesign\proposal\models\Proposal;
use nad\process\materials\coagulant\investigationDesign\report\models\Report;
use nad\process\materials\coagulant\investigationDesign\method\models\Method;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'منعقدکننده', 'url' => ['/coagulant/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/coagulant/manage/investigation-design']],
    ['label' => 'لیست موضوع های فعال', 'url' => ['index']],
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="subject-update">
    <?= $this->render('@nad/common/modules/investigation/subject/views/subject/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
        'reportConsumerCode' => Report::CONSUMER_CODE,
        'methodConsumerCode' => Method::CONSUMER_CODE,
    ]) ?>
</div>
