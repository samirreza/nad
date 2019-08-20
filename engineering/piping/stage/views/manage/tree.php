<?php

$this->title = 'نمایش درختی مراحل';
$this->params['stageIndexBtnLabel'] = 'لیست مراحل لوله کشی';
$this->params['breadcrumbs'] = [
    'فنی',       
    ['label' => 'لوله کشی', 'url' => ['/engineering/piping']],    
    ['label' => 'لیست مراحل', 'url' => ['/engineering/piping/stage/manage/index']],    
    $this->title
];

?>

<?= $this->render('@nad/common/modules/engineering/stage/views/manage/tree');