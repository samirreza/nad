<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'احداث',
    ['label' => 'واحد 1', 'url' => ['/factory/build/unit1/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/factory/build/unit1/manage/investigation3']],
    ['label' => 'رده های منشاها', 'url' => ['/factory/build/unit1/investigation3/source/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/source/views/category/tree', [
        'moduleId' => 'build'
    ]) ?>
</div>
