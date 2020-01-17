<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/piping/stage/manage/investigation-improvement']],
    ['label' => 'لیست گزارش', 'url' => ['index']],
    $this->title
];

?>

<div class="otherreport-view">
    <?= $this->render('@nad/common/modules/investigation/otherreport/views/otherreport/view', [
        'model' => $model,
        'moduleId' => 'stage'
    ]) ?>
</div>
