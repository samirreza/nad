<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'فنی',
    'برق',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/electricity/device/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/electricity/device/manage/investigation-design']],
    ['label' => 'رده های روشها', 'url' => ['/engineering/electricity/device/investigationDesign/method/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/method/views/category/tree', [
        'moduleId' => 'electricity'
    ]) ?>
</div>
