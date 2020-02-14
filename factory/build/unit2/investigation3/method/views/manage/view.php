<?php

$this->title = 'روند ' . $model->title;
$this->params['breadcrumbs'] = [
    'کارخانه',
    'احداث',
    ['label' => 'واحد 2', 'url' => ['/factory/build/unit2/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/factory/build/unit2/manage/investigation3']],
    ['label' => 'لیست روش', 'url' => ['index']],
    $this->title
];

?>

<div class="method-view">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/view', [
        'model' => $model,
        'moduleId' => 'unit2'
    ]) ?>
</div>
