<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'بندر',
    'واحد بندر',
    ['label' => 'واحد 1', 'url' => ['/seaport/wayside/unit1/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/seaport/wayside/unit1/manage/investigation2']],
    ['label' => 'رده های دستورالعملها', 'url' => ['/seaport/wayside/unit1/investigation2/instruction/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/instruction/views/category/tree', [
        'moduleId' => 'wayside'
    ]) ?>
</div>
