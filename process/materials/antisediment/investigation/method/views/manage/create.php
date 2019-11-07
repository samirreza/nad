<?php

use nad\process\materials\antisediment\investigation\reference\models\Reference;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'ضدرسوب', 'url' => ['/antisediment/manage/index']],
    ['label' => 'بررسی', 'url' => ['/antisediment/manage/investigation']],
    $this->title
];

?>

<div class="method-create">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE
    ]) ?>
</div>
