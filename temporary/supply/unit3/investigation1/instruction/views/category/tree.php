<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'موقت',
    'تامین',
    ['label' => 'واحد 3', 'url' => ['/temporary/supply/unit3/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/temporary/supply/unit3/manage/investigation1']],
    ['label' => 'رده های دستورالعملها', 'url' => ['/temporary/supply/unit3/investigation1/instruction/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/instruction/views/category/tree', [
        'moduleId' => 'supply'
    ]) ?>
</div>
