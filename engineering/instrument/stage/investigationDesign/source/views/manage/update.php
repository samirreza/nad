<?php

use nad\engineering\instrument\stage\investigationDesign\source\models\Category;
use nad\engineering\instrument\stage\investigationDesign\reference\models\Reference;

$this->title = 'ویرایش منشا';
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'مراحل', 'url' => ['/engineering/instrument/stage/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/instrument/stage/manage/investigation-design']],
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
