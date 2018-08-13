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
            'create' => [
                'label' => 'افزودن تامین کننده',
                'visibleFor' => ['supplier.create']
            ]
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
                'attribute' => 'type',
                'filter' => Supplier::getTypesList(),
                'value' => function ($model) {
                    return $model->getType();
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
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {phonebook}',
                'buttons' => [
                    'phonebook' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-phone-alt"></span>',
                            ['/supplier/phonebook/manage/list', 'supplierId' => $model->id],
                            ['title' => 'دفترچه تلفن']
                        );
                    }
                ],
                'visibleButtons' => [
                    'view' => \Yii::$app->user->can('supplier.create'),
                    'update' => \Yii::$app->user->can('supplier.update'),
                    'phonebook' => \Yii::$app->user->can('supplier.create')
                ]
            ],
        ]
    ]); ?>
    <?php Pjax::end(); ?>
    <?php Panel::end() ?>
</div>
