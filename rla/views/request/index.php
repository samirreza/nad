<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use core\grid\GridView;
use theme\widgets\Panel;
use yii\helpers\ArrayHelper;
use theme\widgets\ActionButtons;
use core\widgets\select2\Select2;
use nad\common\helpers\Lookup;
use modules\user\backend\models\User;
use nad\office\modules\expert\models\Expert;
use nad\rla\models\RowLevelAccessRequest;

$this->title = 'لیست درخواستها';
$this->params['breadcrumbs'] = [
    'دسترسی',
    $this->title
];
?>

<h2 class="nad-page-title">لیست درخواستها</h2>
<div class="sliding-form-wrapper"></div>

<?= ActionButtons::widget([
    // 'modelID' => $model->id,
    'buttons' => [
        'create' => [
            'label' => 'افزودن درخواست',
            'visible' => !Yii::$app->user->can('superuser')
        ]
    ]
]);
?>

<div class="request-index">
    <?php Panel::begin(['title' => $this->title]) ?>
        <?php Pjax::begin(['id' => 'request-index-gridviewpjax']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'filterUrl' => ['index'],
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn',
                        'options' => [
                            'width' => '20px'
                        ]
                    ],
                    [
                        'attribute' => 'type',
                        'value' => function ($model) {
                            return Lookup::item('nad.rla.request.Type', $model->type);
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'type',
                            'data' => Lookup::items('nad.rla.request.Type'),
                            'options' => [
                                'placeholder' => 'جست‌وجو'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ]
                        ]),
                        'options' => [
                            'width' => '30px'
                        ]
                    ],
                    [
                        'attribute' => 'createdBy',
                        'value' => function ($model) {
                            return User::findOne($model->createdBy)->fullName;
                        },
                        'visible' => !Yii::$app->user->can('superuser'),
                        'filter' => false,
                        'options' => [
                            'width' => '30px'
                        ]
                    ],
                    [
                        'attribute' => 'createdBy',
                        'value' => function ($model) {
                            return User::findOne($model->createdBy)->fullName;
                        },
                        'visible' => \Yii::$app->user->can('superuser'),
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'createdBy',
                            'data' => ArrayHelper::map(
                                expert::getNotDeletedUsers()->all(),
                                'userId',
                                'user.fullName'
                            ),
                            'options' => [
                                'placeholder' => 'جست‌وجو'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ]
                        ]),
                        'options' => [
                            'width' => '30px'
                        ]
                    ],
                    [
                        'attribute' => 'description',
                        'format' => 'html',
                        'options' => [
                            'width' => '300px'
                        ]
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function ($model) {
                            return Lookup::item('nad.rla.request.Status', $model->status);
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'status',
                            'data' => Lookup::items('nad.rla.request.Status'),
                            'options' => [
                                'placeholder' => 'جست‌وجو'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ]
                        ]),
                        'options' => [
                            'width' => '30px'
                        ]
                    ],
                    // [
                    //     'attribute' => 'is_read',
                    //     'value' => function ($model) {
                    //         return Lookup::item('nad.rla.request.IsRead', $model->is_read);
                    //     },
                    //     'format' => 'html',
                    //     'visible' => \Yii::$app->user->can('superuser'),
                    //     'filter' => Select2::widget([
                    //         'model' => $searchModel,
                    //         'attribute' => 'is_read',
                    //         'data' => Lookup::items('nad.rla.request.IsRead'),
                    //         'options' => [
                    //             'placeholder' => 'جست‌وجو'
                    //         ],
                    //         'pluginOptions' => [
                    //             'allowClear' => true
                    //         ]
                    //     ]),
                    //     'options' => [
                    //         'width' => '30px'
                    //     ]
                    // ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'دسترسی',
                        'template' => '{update}',
                        'visible' => \Yii::$app->user->can('superuser'),
                        'options' => [
                            'width' => '50px'
                        ]
                    ]
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
