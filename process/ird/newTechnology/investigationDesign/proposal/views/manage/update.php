<?php

use nad\process\ird\newTechnology\investigationDesign\source\models\Source;
use nad\process\ird\newTechnology\investigationDesign\proposal\models\Category;
use nad\process\ird\newTechnology\investigationDesign\reference\models\Reference;

$this->title = 'ویرایش پروپوزال';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'تکنولوژی های نو', 'url' => ['/process/ird/newTechnology/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/process/ird/newTechnology/manage/investigation-design']],
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
