<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use core\grid\GridView;
use theme\widgets\Panel;
use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use nad\office\modules\expert\models\Expert;
use nad\common\modules\investigation\method\models\Method;

?>

<div class="method-index">
    <?php Panel::begin(['title' => $this->title]) ?>
        <?php Pjax::begin(['id' => 'method-index-gridviewpjax']) ?>
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
                    [
                        'attribute' => 'createdBy',
                        'value' => function ($model) {
                            return $model->researcher->fullName;
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'createdBy',
                            'data' => ArrayHelper::map(
                                Expert::find()->all(),
                                'userId',
                                'user.fullName'
                            ),
                            'options' => [
                                'placeholder' => 'جست‌وجو'
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
                            return Method::getStatusLables()[$model->status];
                        },
                        'filter' => Method::getStatusLables()
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