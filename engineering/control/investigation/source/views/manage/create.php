<?php

use nad\engineering\control\investigation\source\models\Source;

$this->title = 'درج منشا';
$this->params['breadcrumbs'] = [
    'فنی',
    'بررسی، پایش و طراحی',
    ['label' => 'کنترل', 'url' => ['/engineering/control/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/control/manage/investigation']],
    $this->title
];

?>

<div class="source-create">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/_form', [
        'model' => $model,
        'consumer' => Source::CONSUMER_CODE
    ]) ?>
</div>
