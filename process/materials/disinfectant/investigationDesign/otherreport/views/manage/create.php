<?php

use nad\process\materials\disinfectant\investigationDesign\otherreport\models\Category;
use nad\process\materials\disinfectant\investigationDesign\reference\models\Reference;
use nad\process\materials\disinfectant\investigationDesign\subject\models\Subject;

$this->title = 'افزودن گزارش';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/process/materials/disinfectant/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/process/materials/disinfectant/manage/investigation-design']],
    $this->title
];

?>

<div class="otherreport-create">
    <?= $this->render('@nad/common/modules/investigation/otherreport/views/otherreport/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'subjectConsumerCode' => Subject::CONSUMER_CODE,
    ]) ?>
</div>
