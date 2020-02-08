<?php

use nad\engineering\geotechnics\device\investigationImprovement\source\models\Source;
use nad\engineering\geotechnics\device\investigationImprovement\proposal\models\Category;
use nad\engineering\geotechnics\device\investigationImprovement\reference\models\Reference;

$this->title = 'افزودن پروپوزال';
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/geotechnics/device/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/geotechnics/device/manage/investigation-improvement']],
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
