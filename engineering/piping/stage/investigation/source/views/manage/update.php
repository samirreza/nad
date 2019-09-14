<?php

use nad\engineering\piping\stage\investigation\source\models\Source;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فنی',
    'بررسی، پایش و طراحی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage']], 
    ['label' => 'بررسی', 'url' => ['/engineering/piping/stage/manage/investigation']],
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
