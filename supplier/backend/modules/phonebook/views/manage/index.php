<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;
use modules\nad\supplier\backend\modules\phonebook\models\Job;

$this->title = 'لیست شماره تماس ها';
$this->params['breadcrumbs'][] = ['label' => 'لیست تامین کنندگان', 'url' => ['/supplier/manage/index']];
$this->params['breadcrumbs'][] = ['label' => $supplier->name, 'url' => ['/supplier/manage/view','id' => $supplier->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phonebook-manage-list">

    <?= ActionButtons::widget([
        'buttons' => [
            'addPhone' => [
                'label' => 'افزودن شماره تماس',
                'url' => ['create', 'supplierId' => $supplierId],
                'icon' => 'plus',
                'type' => 'success',
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
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'lead-update'),
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $model) {
                    if ($action === 'delete') {
                        $url = '/admin/supplier/phonebook/delete?id=' . $model->id .
                            '&supplierId=' . $model->supplierId;
                        return $url;
                    }
                    if ($action === 'update') {
                        $url = '/admin/supplier/phonebook/update?id=' . $model->id .
                            '&supplierId=' . $model->supplierId;
                        return $url;
                    }
                }
            ],
        ]
    ]); ?>
    <?php Pjax::end(); ?>
    <?php Panel::end() ?>
</div>
