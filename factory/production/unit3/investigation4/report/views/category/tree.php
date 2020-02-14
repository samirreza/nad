<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'واحد 3', 'url' => ['/factory/production/unit3/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/factory/production/unit3/manage/investigation4']],
    ['label' => 'رده های گزارشات', 'url' => ['/factory/production/unit3/investigation4/report/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/report/views/category/tree', [
        'moduleId' => 'production'
    ]) ?>
</div>
