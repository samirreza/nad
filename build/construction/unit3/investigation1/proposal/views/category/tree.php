<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'احداث',
    'ساختمان',
    ['label' => 'واحد 3', 'url' => ['/build/construction/unit3/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/build/construction/unit3/manage/investigation1']],
    ['label' => 'رده های پروپوزالها', 'url' => ['/build/construction/unit3/investigation1/proposal/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/category/tree', [
        'moduleId' => 'construction'
    ]) ?>
</div>
