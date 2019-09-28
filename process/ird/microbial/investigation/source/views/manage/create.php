<?php

use nad\process\ird\microbial\investigation\source\models\Source;

$this->title = 'درج منشا';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'میکروبی', 'url' => ['/microbial/manage/index']],
    ['label' => 'بررسی', 'url' => ['/microbial/manage/investigation']],
    $this->title
];

?>

<div class="source-create">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/_form', [
        'model' => $model,
        'consumer' => Source::CONSUMER_CODE
    ]) ?>
</div>
