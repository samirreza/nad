<?php

$this->title = $model->title;
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    'استخر',
    'بررسی',
    ['label' => 'منشاها', 'url' => ['index']],
    $this->title
];

?>

<div class="source-view">
    <?= $this->render('@nad/common/modules/investigation/source/views/manage/view', [
        'model' => $model
    ]) ?>
</div>
