<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage/manage/index']],
    ['label' => 'روش  و دستورالعمل', 'url' => ['/engineering/piping/stage/manage/investigation-improvement']],
    ['label' => 'رده های گزارشات', 'url' => ['/engineering/piping/stage/investigationImprovement/report/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/report/views/category/tree', [
        'moduleId' => 'piping'
    ]) ?>
</div>
