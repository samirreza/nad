<?php

use nad\engineering\mechanics\investigation\source\models\Source;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'مکانیک', 'url' => ['/engineering/mechanics/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/mechanics/manage/investigation']],
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
