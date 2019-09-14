<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'بررسی، پایش و طراحی',
    ['label' => 'کنترل', 'url' => ['/engineering/control/manage/index']],
    ['label' => 'بررسی', 'url' => ['/engineering/control/manage/investigation']],
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
