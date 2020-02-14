<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'موقت',
    'تامین',
    ['label' => 'واحد 2', 'url' => ['/temporary/supply/unit2/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/temporary/supply/unit2/manage/investigation5']],
    ['label' => 'رده های دستورالعملها', 'url' => ['/temporary/supply/unit2/investigation5/instruction/category/index']],
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
