<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'فرایند',
    'مواد',
    ['label' => 'لاک بیرنگ', 'url' => ['/process/materials/lacquer/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/process/materials/lacquer/manage/investigation']],
    ['label' => 'رده های منشاها', 'url' => ['/process/materials/lacquer/investigation/source/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/source/views/category/tree', [
        'moduleId' => 'piping'
    ]) ?>
</div>
