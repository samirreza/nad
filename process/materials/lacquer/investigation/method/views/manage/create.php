<?php

use nad\process\materials\lacquer\investigation\reference\models\Reference;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'لاک بیرنگ', 'url' => ['/process/materials/lacquer/manage/index']],
    ['label' => 'بررسی', 'url' => ['/process/materials/lacquer/manage/investigation']],
    $this->title
];

?>

<div class="method-create">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE
    ]) ?>
</div>
