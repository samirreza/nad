<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/instrument/device/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/instrument/device/manage/investigation-improvement']],
    ['label' => 'رده های منشاها', 'url' => ['/engineering/instrument/device/investigationImprovement/source/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/source/views/category/tree', [
        'moduleId' => 'instrument'
    ]) ?>
</div>