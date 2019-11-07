<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'رنگ ها', 'url' => ['/colors/manage/index']],
    ['label' => 'بررسی پایش', 'url' => ['/colors/manage/investigation-monitor']],
    ['label' => 'رده های منشاها', 'url' => ['/colors/investigationMonitor/source/category/index']],
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
