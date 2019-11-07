<?php

use nad\process\materials\coagulant\investigationDesign\source\models\Source;
use nad\process\materials\coagulant\investigationDesign\proposal\models\Category;
use nad\process\materials\coagulant\investigationDesign\reference\models\Reference;

$this->title = 'افزودن پروپوزال';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'منعقدکننده', 'url' => ['/coagulant/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/coagulant/manage/investigation-design']],
    $this->title
];

?>

<div class="proposal-create">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'sourceConsumerCode' => Source::CONSUMER_CODE
    ]) ?>
</div>
