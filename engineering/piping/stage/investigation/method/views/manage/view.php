<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'بررسی، پایش و طراحی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage']], 
    ['label' => 'بررسی', 'url' => ['/engineering/piping/stage/manage/investigation']],
    ['label' => 'لیست روش‌ها', 'url' => ['index']],
    $this->title
];

?>

<div class="method-view">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/view', [
        'model' => $model,
        'moduleId' => 'method'
    ]) ?>
</div>
