<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;

$this->title = 'سمت ها';
$this->params['breadcrumbs'][] = ['label' => 'لیست تعمیرکاران', 'url' => ['/repairer/manage/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-manage-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن سمت',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'job-gridviewpjax'
                ]
            ],

            'repairerList' => [
                'label' => 'لیست تعمیرکاران',
                'url' => ['/repairer/manage/index'],
                'icon' => 'list',
                'type' => 'info',
            ],
        ]
    ]) ?>


    <div class="sliding-form-wrapper"></div>


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
            [
                'class' => 'core\grid\TitleColumn',
                'isAjaxGrid' => true
            ],
            [
                'attribute' => 'createdAt',
                'format' => 'date',
                'filter' => false
            ],
            ['class' => 'core\grid\AjaxActionColumn']
        ]
    ]); ?>
    <?php Pjax::end(); ?>
    <?php Panel::end() ?>
</div>