<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/piping/device/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/piping/device/manage/investigation-monitor-methods']],
    ['label' => 'رده های منشاها', 'url' => ['/engineering/piping/device/investigationMonitorMethods/source/category/index']],
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
