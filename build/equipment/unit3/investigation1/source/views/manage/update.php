<?php

use nad\build\equipment\unit3\investigation1\source\models\Category;
use nad\build\equipment\unit3\investigation1\reference\models\Reference;

$this->title = 'ویرایش منشا';
$this->params['breadcrumbs'] = [
    'احداث',
    'تجهیزات',
    ['label' => 'واحد 3', 'url' => ['/build/equipment/unit3/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/build/equipment/unit3/manage/investigation1']],
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
