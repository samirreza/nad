<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'تعمیرات و نگهداری', 'url' => ['/factory/production/unit4/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/factory/production/unit4/manage/investigation1']],
    ['label' => 'رده های روشها', 'url' => ['/factory/production/unit4/investigation1/method/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/method/views/category/tree', [
        'moduleId' => 'production'
    ]) ?>
</div>
