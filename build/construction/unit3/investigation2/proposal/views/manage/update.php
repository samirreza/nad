<?php

use nad\build\construction\unit3\investigation2\source\models\Source;
use nad\build\construction\unit3\investigation2\proposal\models\Category;
use nad\build\construction\unit3\investigation2\reference\models\Reference;

$this->title = 'ویرایش پروپوزال';
$this->params['breadcrumbs'] = [
    'احداث',
    'ساختمان',
    ['label' => 'واحد 3', 'url' => ['/build/construction/unit3/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/build/construction/unit3/manage/investigation2']],
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
