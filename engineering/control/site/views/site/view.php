<?php

$this->title = 'روند مکان';
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'لیست مکان ها', 'url' => ['/engineering/control/site/site/index']],
    $this->title
];

?>

<div class="site-view">
    <?= $this->render('@nad/common/modules/site/views/site/view', [
        'model' => $model
    ]) ?>
</div>
