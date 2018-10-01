<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;

$this->title = 'لیست سازندگان';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maker-manage-index">

    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن سازنده',
                'visibleFor' => ['maker.create']
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

    <?= $this->render('_search', ['model' => $searchModel]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'core\grid\TitleColumn',
                'attribute' => 'title'
            ],
            [
                'attribute' => 'isLegal',
                'filter' => ['حقیقی', 'حقوقی'],
                'value' => function ($model) {
                    return $model->isLegal ? 'حقوقی' : 'حقیقی';
                }
            ],
            [
                'attribute' => 'phoneCount',
                'value' => function ($model) {
                    return count($model->phones);
                },
                'format' => 'farsiNumber',
            ],
            ['class' => 'core\grid\ActiveColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {phonebook}',
                'buttons' => [
                    'phonebook' => function ($url, $model) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-phone-alt"></span>',
                            ['/maker/phonebook/manage/list', 'makerId' => $model->id],
                            ['title' => 'دفترچه تلفن']
                        );
                    }
                ],
                'visibleButtons' => [
                    'view' => \Yii::$app->user->can('maker.create'),
                    'update' => \Yii::$app->user->can('maker.update'),
                    'phonebook' => \Yii::$app->user->can('maker.create')
                ]
            ],
        ]
    ]); ?>
    <?php Pjax::end(); ?>
    <?php Panel::end() ?>
</div>
