<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'احداث',
    'تجهیزات',
    ['label' => 'واحد 3', 'url' => ['/build/equipment/unit3/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/build/equipment/unit3/manage/investigation1']],
    ['label' => 'رده های روشها', 'url' => ['/build/equipment/unit3/investigation1/method/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/method/views/category/tree', [
        'moduleId' => 'equipment'
    ]) ?>
</div>
