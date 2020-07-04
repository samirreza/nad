<?php

use nad\process\materials\antimicrobial\investigation\reference\models\Reference;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'ضدمیکروب', 'url' => ['/process/materials/antimicrobial/manage/index']],
    ['label' => 'بررسی', 'url' => ['/process/materials/antimicrobial/manage/investigation']],
    $this->title
];

?>

<div class="method-create">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE
    ]) ?>
</div>
