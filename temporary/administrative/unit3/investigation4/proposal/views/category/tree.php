<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'موقت',
    'اداری',
    ['label' => 'واحد 3', 'url' => ['/temporary/administrative/unit3/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/temporary/administrative/unit3/manage/investigation4']],
    ['label' => 'رده های پروپوزالها', 'url' => ['/temporary/administrative/unit3/investigation4/proposal/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/category/tree', [
        'moduleId' => 'administrative'
    ]) ?>
</div>
