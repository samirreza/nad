<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'مراحل', 'url' => ['/engineering/instrument/stage/manage/index']],
    ['label' => 'بررسی روشهای پایش', 'url' => ['/engineering/instrument/stage/manage/investigation-monitor-methods']],
    ['label' => 'رده های دستورالعملها', 'url' => ['/engineering/instrument/stage/investigationMonitorMethods/instruction/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/instruction/views/category/tree', [
        'moduleId' => 'instrument'
    ]) ?>
</div>
