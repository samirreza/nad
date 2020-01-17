<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/process/materials/disinfectant/manage/index']],
    ['label' => 'مطالعات کلی و دستورالعمل ها', 'url' => ['/process/materials/disinfectant/manage/investigation-design']],
    ['label' => 'لیست گزارش', 'url' => ['index']],
    $this->title
];

?>

<div class="otherreport-view">
    <?= $this->render('@nad/common/modules/investigation/otherreport/views/otherreport/view', [
        'model' => $model,
        'moduleId' => 'disinfectant'
    ]) ?>
</div>
