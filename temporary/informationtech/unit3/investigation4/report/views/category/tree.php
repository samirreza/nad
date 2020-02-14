<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'موقت',
    'آی تی',
    ['label' => 'واحد 3', 'url' => ['/temporary/informationtech/unit3/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/temporary/informationtech/unit3/manage/investigation4']],
    ['label' => 'رده های گزارشات', 'url' => ['/temporary/informationtech/unit3/investigation4/report/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/report/views/category/tree', [
        'moduleId' => 'informationtech'
    ]) ?>
</div>
