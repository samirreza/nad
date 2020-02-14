<?php

use nad\temporary\informationtech\unit1\investigation3\source\models\Category;
use nad\temporary\informationtech\unit1\investigation3\reference\models\Reference;

$this->title = 'افزودن منشا';
$this->params['breadcrumbs'] = [
    'موقت',
    'آی تی',
    ['label' => 'واحد 1', 'url' => ['/temporary/informationtech/unit1/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/temporary/informationtech/unit1/manage/investigation3']],
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
