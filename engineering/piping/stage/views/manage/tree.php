<?php

$this->title = 'نمایش درختی مراحل';
$this->params['stageIndexBtnLabel'] = 'لیست مراحل لوله کشی';
$this->params['breadcrumbs'] = [
    'فنی',       
    'لوله کشی',
    ['label' => 'لیست مراحل', 'url' => ['/engineering/piping/stage/manage/index']],    
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/stage/views/manage/tree');