<?php

$this->title = 'درج منشا';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    'استخر',
    'بررسی',
    $this->title
];

?>

<div class="source-create">
    <?= $this->render('@nad/common/modules/investigation/source/views/manage/_form', [
        'model' => $model
    ]) ?>
</div>
