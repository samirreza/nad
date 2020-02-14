<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'احداث',
    'چاه',
    ['label' => 'واحد 1', 'url' => ['/build/well/unit1/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/build/well/unit1/manage/investigation5']],
    ['label' => 'رده های روشها', 'url' => ['/build/well/unit1/investigation5/method/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/method/views/category/tree', [
        'moduleId' => 'well'
    ]) ?>
</div>
