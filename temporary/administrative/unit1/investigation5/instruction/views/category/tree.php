<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'موقت',
    'اداری',
    ['label' => 'واحد 1', 'url' => ['/temporary/administrative/unit1/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/temporary/administrative/unit1/manage/investigation5']],
    ['label' => 'رده های دستورالعملها', 'url' => ['/temporary/administrative/unit1/investigation5/instruction/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/instruction/views/category/tree', [
        'moduleId' => 'administrative'
    ]) ?>
</div>
