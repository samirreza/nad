<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'فنی', 'url' => ['/factory/production/unit1/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/factory/production/unit1/manage/investigation2']],
    ['label' => 'رده های گزارشات', 'url' => ['/factory/production/unit1/investigation2/report/category/index']],
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
