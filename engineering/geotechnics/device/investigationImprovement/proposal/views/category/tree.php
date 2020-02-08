<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/geotechnics/device/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/geotechnics/device/manage/investigation-improvement']],
    ['label' => 'رده های پروپوزالها', 'url' => ['/engineering/geotechnics/device/investigationImprovement/proposal/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/category/tree', [
        'moduleId' => 'geotechnics'
    ]) ?>
</div>
