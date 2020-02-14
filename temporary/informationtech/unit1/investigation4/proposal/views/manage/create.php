<?php

use nad\temporary\informationtech\unit1\investigation4\source\models\Source;
use nad\temporary\informationtech\unit1\investigation4\proposal\models\Category;
use nad\temporary\informationtech\unit1\investigation4\reference\models\Reference;

$this->title = 'افزودن پروپوزال';
$this->params['breadcrumbs'] = [
    'موقت',
    'آی تی',
    ['label' => 'واحد 1', 'url' => ['/temporary/informationtech/unit1/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/temporary/informationtech/unit1/manage/investigation4']],
    $this->title
];

?>

<div class="proposal-create">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'sourceConsumerCode' => Source::CONSUMER_CODE
    ]) ?>
</div>
