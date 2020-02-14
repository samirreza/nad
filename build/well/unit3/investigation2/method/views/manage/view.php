<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'احداث',
    'چاه',
    ['label' => 'واحد 3', 'url' => ['/build/well/unit3/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/build/well/unit3/manage/investigation2']],
    ['label' => 'لیست روش', 'url' => ['index']],
    $this->title
];

?>

<div class="method-view">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/view', [
        'model' => $model,
        'moduleId' => 'unit3'
    ]) ?>
</div>
