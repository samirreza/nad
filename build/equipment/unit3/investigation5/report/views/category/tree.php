<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'احداث',
    'ساختمان',
    ['label' => 'واحد 3', 'url' => ['/build/equipment/unit3/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/build/equipment/unit3/manage/investigation5']],
    ['label' => 'رده های گزارشات', 'url' => ['/build/equipment/unit3/investigation5/report/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/report/views/category/tree', [
        'moduleId' => 'equipment'
    ]) ?>
</div>
