<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use core\grid\GridView;
use theme\widgets\Panel;
use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use nad\office\modules\expert\models\Expert;
use nad\common\modules\investigation\source\models\Source;
use nad\common\modules\investigation\source\models\SourceReason;

?>

<div class="source-index">
    <?php Panel::begin(['title' => $this->title]) ?>
        <?php Pjax::begin(['id' => 'source-index-gridviewpjax']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'filterUrl' => ['index'],
                'columns' => [
                    [
                        'attribute' => 'title',
                        'filterInputOptions' => [
                            'class' => 'form-control',
                            'placeholder' => 'جست‌و‌جو عنوان'
                        ]
                    ],
                    [
                        'class' => 'nad\common\code\CodeGridColumn',
                        'filterInputOptions' => [
                            'class' => 'form-control',
                            'placeholder' => 'جست‌و‌جو'
                        ]
                    ],
                    // [
                    //     'attribute' => 'createdBy',
                    //     'value' => function ($model) {
                    //         return $model->researcher->fullName;
                    //     },
                    //     'filter' => Select2::widget([
                    //         'model' => $searchModel,
                    //         'attribute' => 'createdBy',
                    //         'data' => ArrayHelper::map(
                    //             Expert::find()->all(),
                    //             'userId',
                    //             'fullName'
                    //         ),
                    //         'options' => [
                    //             'placeholder' => 'جست‌وجو'
                    //         ],
                    //         'pluginOptions' => [
                    //             'allowClear' => true
                    //         ]
                    //     ])
                    // ],
                    [
                        'attribute' => 'mainReasonId',
                        'value' => function ($model) {
                            return $model->mainReason->title;
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'mainReasonId',
                            'data' => ArrayHelper::map(
                                SourceReason::find()->all(),
                                'id',
                                'title'
                            ),
                            'options' => [
                                'placeholder' => 'انتخاب علت'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ]
                        ])
                    ],
                    [
                        'attribute' => 'createdAt',
                        'value' => function ($model) {
                            return Yii::$app->formatter->asDate(
                                $model->createdAt,
                                'Y-M-d'
                            );
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function ($model) {
                            return Source::getStatusLables()[$model->status];
                        },
                        'filter' => Source::getStatusLables()
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'روند',
                        'template' => '{view}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-eye-open"></span>',
                                    $url,
                                    [
                                        'title' => 'روند',
                                        'style' => 'color: green'
                                    ]
                                );
                            }
                        ]
                    ]
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
