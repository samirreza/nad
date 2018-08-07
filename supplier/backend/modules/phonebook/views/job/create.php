<?php

use themes\admin360\widgets\ActionButtons;

$this->title = 'سمت جدید';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-create">
    <?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'لیست سمت ها'],
        ],
    ]); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
