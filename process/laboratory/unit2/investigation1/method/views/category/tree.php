<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'فرایند',
    'آزمایشگاه',
    ['label' => 'واحد 2', 'url' => ['/process/laboratory/unit2/manage/index']],
    ['label' => 'فعالیت بررسی', 'url' => ['/process/laboratory/unit2/manage/investigation1']],
    ['label' => 'رده های روشها', 'url' => ['/process/laboratory/unit2/investigation1/method/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/method/views/category/tree', [
        'moduleId' => 'laboratory'
    ]) ?>
</div>
