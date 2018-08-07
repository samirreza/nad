<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;
use modules\nad\supplier\backend\models\Supplier;

$this->title = 'لیست تامین کنندگان';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-manage-index">

    <?= ActionButtons::widget([
        'buttons' => [
            'create' => ['label' => 'افزودن تامین کننده'],
        ],
    ]); ?>

    <?php Panel::begin([
        'title' => Html::encode($this->title)
    ]) ?>
    <?php Pjax::begin([
        'id' => 'product-gridviewpjax',
        'enablePushState' => false,
    ]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'core\grid\IDColumn'],
            'name',
            [
                'attribute' => 'isForeign',
                'filter' => ['داخلی', 'خارجی'],
                'value' => function ($model) {
                    return $model->isForeign ? 'خارجی' : 'داخلی';
                }
            ],
            [
                'attribute' => 'kind',
                'filter' => Supplier::getKindsList(),
                'value' => function ($model) {
                    return $model->getKind();
                }
            ],
            [
                'attribute' => 'createdAt',
                'format' => 'date',
                'filter' => false
            ],
            [
                'attribute' => 'phoneCount',
                'value' => function ($model) {
                    return count($model->phones);
                },
                'format' => 'farsiNumber',
            ],
            [
                'class' => 'core\grid\ActionColumn',
                'visibleButtons' => [
                    'update' => Yii::$app->user->can('supplier.update'),
                    'delete' => Yii::$app->user->can('supplier.delete')
                ]
            ]
        ]
    ]); ?>
    <?php Pjax::end(); ?>
    <?php Panel::end() ?>
</div>
