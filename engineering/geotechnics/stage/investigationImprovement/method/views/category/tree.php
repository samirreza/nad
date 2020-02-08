<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'فنی',
    'ژئوتکنیک',
    ['label' => 'مراحل', 'url' => ['/engineering/geotechnics/stage/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/geotechnics/stage/manage/investigation-improvement']],
    ['label' => 'رده های روشها', 'url' => ['/engineering/geotechnics/stage/investigationImprovement/method/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/method/views/category/tree', [
        'moduleId' => 'geotechnics'
    ]) ?>
</div>
