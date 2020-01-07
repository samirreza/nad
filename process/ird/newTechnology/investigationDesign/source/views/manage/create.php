<?php

use nad\process\ird\newTechnology\investigationDesign\source\models\Category;
use nad\process\ird\newTechnology\investigationDesign\reference\models\Reference;

$this->title = 'افزودن منشا';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'تکنولوژی های نو', 'url' => ['/newTechnology/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/newTechnology/manage/investigation-design']],
    'برنامه منشا',
    $this->title
];

?>

<div class="source-create">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
    ]) ?>
</div>
