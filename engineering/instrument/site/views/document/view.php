<?php

$this->title = 'روند مدرک';
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'لیست مکان ها', 'url' => ['/engineering/instrument/site/site/index']],
    $this->title
];

?>

<div class="document-view">
    <?= $this->render('@nad/common/modules/site/views/document/view', [
        'model' => $model
    ]) ?>
</div>
