<?php

use nad\seaport\wayside\unit1\investigation5\source\models\Source;
use nad\seaport\wayside\unit1\investigation5\proposal\models\Category;
use nad\seaport\wayside\unit1\investigation5\reference\models\Reference;

$this->title = 'ویرایش پروپوزال';
$this->params['breadcrumbs'] = [
    'بندر',
    'واحد بندر',
    ['label' => 'واحد 1', 'url' => ['/seaport/wayside/unit1/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/seaport/wayside/unit1/manage/investigation5']],
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
