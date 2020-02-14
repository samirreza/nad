<?php

use nad\temporary\informationtech\unit2\investigation1\source\models\Source;
use nad\temporary\informationtech\unit2\investigation1\proposal\models\Category;
use nad\temporary\informationtech\unit2\investigation1\reference\models\Reference;

$this->title = 'ویرایش پروپوزال';
$this->params['breadcrumbs'] = [
    'موقت',
    'آی تی',
    ['label' => 'واحد 2', 'url' => ['/temporary/informationtech/unit2/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/temporary/informationtech/unit2/manage/investigation1']],
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
