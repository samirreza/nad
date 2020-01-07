<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'آر او', 'url' => ['/ro/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/ro/manage/investigation-design']],
    ['label' => 'رده های پروپوزالها', 'url' => ['/ro/investigationDesign/proposal/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/category/tree', [
        'moduleId' => 'piping'
    ]) ?>
</div>
