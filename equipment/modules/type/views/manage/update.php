<?php
use yii\helpers\Html;
use themes\admin360\widgets\ActionButtons;

$this->title = 'ویرایش نوع تجهیز';
$this->params['breadcrumbs'][] = 'تجهیزات';
$this->params['breadcrumbs'][] = ['label' => 'انواع', 'url' => ['index']];
$this->params['breadcrumbs'][] = [
    'label' => $model->title,
    'url' => ['view', 'id' => $model->id]
];
$this->params['breadcrumbs'][] = 'ویرایش';
?>
<div class="faq-manage-update">
    <?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'انواع تجهیزات'],
            'create' => ['label' => 'نوع تجهیز جدید'],
        ],
    ]); ?>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
