<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;

$this->title = 'سمت ها';
$this->params['breadcrumbs'][] = ['label' => 'لیست تامین کنندگان', 'url' => ['/supplier/manage/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-manage-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => ['label' => 'افزودن سمت'],
            'supplierList' => [
                'label' => 'لیست تامین کنندگان',
                'url' => ['/supplier/manage/index'],
                'icon' => 'list',
                'type' => 'info',
            ],
        ]
    ]) ?>

    <?php Panel::begin([
        'title' => Html::encode($this->title)
    ]) ?>
    <?php Pjax::begin([
        'id' => 'job-gridviewpjax',
        'enablePushState' => false,
    ]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'core\grid\IDColumn'],
            'title',
            [
                'attribute' => 'createdAt',
                'format' => 'date',
                'filter' => false
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}',
            ],
        ]
    ]); ?>
    <?php Pjax::end(); ?>
    <?php Panel::end() ?>
</div>
