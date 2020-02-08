<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'مراحل', 'url' => ['/engineering/control/stage/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/control/stage/manage/investigation-design']],
    ['label' => 'رده های پروپوزالها', 'url' => ['/engineering/control/stage/investigationDesign/proposal/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/category/tree', [
        'moduleId' => 'control'
    ]) ?>
</div>
