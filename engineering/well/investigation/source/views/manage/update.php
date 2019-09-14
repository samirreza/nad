<?php

use nad\engineering\well\investigation\source\models\Source;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فنی',
    'بررسی، پایش و طراحی',
    ['label' => 'چاه', 'url' => ['/engineering/well/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/well/manage/investigation']],
    ['label' => 'لیست منشا', 'url' => ['index']],
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="source-update">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/_form', [
        'model' => $model,
        'consumer' => Source::CONSUMER_CODE
    ]) ?>
</div>
