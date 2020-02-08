<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'مکانیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/mechanics/device/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/mechanics/device/manage/investigation-design']],
    ['label' => 'لیست روش', 'url' => ['index']],
    $this->title
];

?>

<div class="method-view">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/view', [
        'model' => $model,
        'moduleId' => 'device'
    ]) ?>
</div>
