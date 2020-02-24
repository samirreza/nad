<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'تولید',
    ['label' => 'آزمایشگاه', 'url' => ['/factory/production/unit2/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/factory/production/unit2/manage/investigation3']],
    ['label' => 'رده های دستورالعملها', 'url' => ['/factory/production/unit2/investigation3/instruction/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/instruction/views/category/tree', [
        'moduleId' => 'production'
    ]) ?>
</div>
