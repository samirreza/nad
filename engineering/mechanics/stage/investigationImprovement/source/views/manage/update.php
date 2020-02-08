<?php

use nad\engineering\mechanics\stage\investigationImprovement\source\models\Category;
use nad\engineering\mechanics\stage\investigationImprovement\reference\models\Reference;

$this->title = 'ویرایش منشا';
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'مراحل', 'url' => ['/engineering/mechanics/stage/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/mechanics/stage/manage/investigation-improvement']],
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
