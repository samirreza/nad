<?php
use yii\helpers\Html;
use themes\admin360\widgets\ActionButtons;

$this->title = 'ویرایش دسته';
$this->params['breadcrumbs'] = [
    'تجهیزات',
    ['label' => 'انواع', 'url' => ['manage/index']],
    ['label' => $model->code, 'url' => ['view', 'id' => $model->id]],
    'ویرایش'
];
?>
<div class="page-update">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'create' => ['label' => 'دسته جدید'],
            'index' => ['label' => 'دسته ها'],
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
