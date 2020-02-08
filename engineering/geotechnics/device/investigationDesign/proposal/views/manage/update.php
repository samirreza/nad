<?php

use nad\engineering\geotechnics\device\investigationDesign\source\models\Source;
use nad\engineering\geotechnics\device\investigationDesign\proposal\models\Category;
use nad\engineering\geotechnics\device\investigationDesign\reference\models\Reference;

$this->title = 'ویرایش پروپوزال';
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/geotechnics/device/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/geotechnics/device/manage/investigation-design']],
    ['label' => 'لیست پروپوزال', 'url' => ['index']],
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="proposal-update">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'sourceConsumerCode' => Source::CONSUMER_CODE
    ]) ?>
</div>
