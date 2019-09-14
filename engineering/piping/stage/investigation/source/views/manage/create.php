<?php

use nad\engineering\piping\stage\investigation\source\models\Source;

$this->title = 'درج منشا';
$this->params['breadcrumbs'] = [
    'فنی',
    'بررسی، پایش و طراحی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage']], 
    ['label' => 'بررسی', 'url' => ['/engineering/piping/stage/manage/investigation']],
    $this->title
];

?>

<div class="source-create">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/_form', [
        'model' => $model,
        'consumer' => Source::CONSUMER_CODE
    ]) ?>
</div>
