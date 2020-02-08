<?php

use nad\engineering\geotechnics\device\investigationImprovement\source\models\Category;
use nad\engineering\geotechnics\device\investigationImprovement\reference\models\Reference;

$this->title = 'ویرایش منشا';
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/geotechnics/device/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/geotechnics/device/manage/investigation-improvement']],
    'برنامه منشا',
    ['label' => 'لیست منشاهای برنامه', 'url' => ['index']],
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="source-update">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
    ]) ?>
</div>
