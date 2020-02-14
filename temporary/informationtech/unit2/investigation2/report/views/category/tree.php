<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'موقت',
    'آی تی',
    ['label' => 'واحد 2', 'url' => ['/temporary/informationtech/unit2/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/temporary/informationtech/unit2/manage/investigation2']],
    ['label' => 'رده های گزارشات', 'url' => ['/temporary/informationtech/unit2/investigation2/report/category/index']],
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
