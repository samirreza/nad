<?php
use yii\helpers\Html;
use themes\admin360\widgets\ActionButtons;

$this->title = 'دسته جدید';
$this->params['breadcrumbs'] = [
    'تجهیزات',
    ['label' => 'انواع', 'url' => ['manage/index']],
    $this->title
];
?>
<div class="category-create">
    <?= ActionButtons::widget([
        'buttons' => [
            'index' => ['label' => 'دسته ها'],
        ],
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
