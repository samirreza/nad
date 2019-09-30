<?php

$this->title = 'مراحل (نمایش درختی)';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'لیست مراحل', 'url' => ['/engineering/piping/stage/category/index']],
    'نمایش درختی'
];
?>

<h4 class="nad-page-title">مراحل (نمایش درختی)</h4>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/engineering/stage/views/category/tree', [
        'moduleId' => 'piping'
    ]) ?>
</div>
