<?php

$this->title = 'روند مکان';
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'لیست مکان ها', 'url' => ['/engineering/electricity/site/site/index']],
    $this->title
];

?>

<div class="site-view">
    <?= $this->render('@nad/common/modules/site/views/site/view', [
        'model' => $model
    ]) ?>
</div>
