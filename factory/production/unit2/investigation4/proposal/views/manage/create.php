<?php

use nad\factory\production\unit2\investigation4\source\models\Source;
use nad\factory\production\unit2\investigation4\proposal\models\Category;
use nad\factory\production\unit2\investigation4\reference\models\Reference;

$this->title = 'افزودن پروپوزال';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'آزمایشگاه', 'url' => ['/factory/production/unit2/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/factory/production/unit2/manage/investigation4']],
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
