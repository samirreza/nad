<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'پشتیبانی',
    ['label' => 'واحد 3', 'url' => ['/factory/support/unit3/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/factory/support/unit3/manage/investigation5']],
    ['label' => 'رده های منشاها', 'url' => ['/factory/support/unit3/investigation5/source/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/source/views/category/tree', [
        'moduleId' => 'support'
    ]) ?>
</div>
