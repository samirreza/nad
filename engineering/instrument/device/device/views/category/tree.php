<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/instrument/device/manage/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/device/views/category/tree', [
        'moduleId' => 'instrument'
    ]) ?>
</div>
