<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'ضدمیکروب', 'url' => ['/antimicrobial/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/antimicrobial/manage/investigation-design']],
    ['label' => 'رده های پروپوزالها', 'url' => ['/antimicrobial/investigationDesign/proposal/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/category/tree', [
        'moduleId' => 'piping'
    ]) ?>
</div>
