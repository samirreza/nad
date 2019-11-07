<?php

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'ضدمیکروب', 'url' => ['/antimicrobial/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/antimicrobial/manage/investigation-design']],
    ['label' => 'رده های گزارشات', 'url' => ['/antimicrobial/investigationDesign/report/category/index']],
    $this->title
];

?>

<h4 class="nad-page-title">نمایش درختی</h4>
<br>
<div class="tree-view">
    <?= $this->render('@nad/common/modules/investigation/report/views/category/tree', [
        'moduleId' => 'piping'
    ]) ?>
</div>
