<?php

$this->title = 'روند مکان';
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'لیست مکان ها', 'url' => ['/engineering/geotechnics/site/site/index']],
    $this->title
];

?>

<div class="site-view">
    <?= $this->render('@nad/common/modules/site/views/site/view', [
        'model' => $model
    ]) ?>
</div>
