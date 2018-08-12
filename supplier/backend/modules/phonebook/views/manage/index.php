<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;
use modules\nad\supplier\backend\modules\phonebook\models\Job;

$this->title = 'لیست شماره تماس ها';
$this->params['breadcrumbs'][] = [
    'label' => 'لیست تامین کنندگان',
    'url' => ['/supplier/manage/index']
];
$this->params['breadcrumbs'][] = [
    'label' => $supplier->name,
    'url' => ['/supplier/manage/view', 'id' => $supplier->id]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phonebook-manage-list">

    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن شماره تماس',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'phoebook-gridviewpjax',
                    'data-supplierId' => $supplierId
                ]
            ],
            'job' => [
                'label' => 'مدیریت سمت ها',
                'url' => ['job/index'],
                'icon' => 'male',
                'type' => 'warning',
            ],
            'supplierInfo' => [
                'label' => 'اطلاعات تامین کننده',
                'url' => ['/supplier/manage/view', 'id' => $supplierId],
                'icon' => 'info',
                'type' => 'primary',
            ],
        ]
    ]) ?>

    <div class="sliding-form-wrapper"></div>

    <?php Panel::begin([
        'title' => Html::encode($this->title)
    ]) ?>
    <?php Pjax::begin([
        'id' => 'phoebook-gridviewpjax',
        'enablePushState' => false,
    ]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                'attribute' => 'jobId',
                'filter' => ArrayHelper::map(
                    Job::find()
                        ->all(),
                    'id',
                    'title'
                ),
                'value' => function ($model) {
                    return $model->job->title;
                },
            ],
            'phone',
            [
                'class' => 'core\grid\AjaxActionColumn',
                'template' => '{update} {delete}',
            ],
        ]
    ]); ?>
    <?php Pjax::end(); ?>
    <?php Panel::end() ?>
</div>
