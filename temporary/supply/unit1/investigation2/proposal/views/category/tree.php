<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'موقت',
    'تامین',
    ['label' => 'واحد 1', 'url' => ['/temporary/supply/unit1/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/temporary/supply/unit1/manage/investigation2']],
    ['label' => 'رده های پروپوزالها', 'url' => ['/temporary/supply/unit1/investigation2/proposal/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/category/tree', [
        'moduleId' => 'supply'
    ]) ?>
</div>