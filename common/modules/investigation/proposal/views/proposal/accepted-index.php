<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use core\grid\GridView;
use theme\widgets\Panel;
use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use nad\office\modules\expert\models\Expert;
use nad\common\modules\investigation\proposal\models\Proposal;

?>

<div class="proposal-index">
    <?php Panel::begin(['title' => $this->title]) ?>
        <?php Pjax::begin(['id' => 'proposal-index-gridviewpjax']) ?>
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
                            return Proposal::getStatusLables()[$model->status];
                        },
                        'filter' => Proposal::getStatusLables()
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'روند',
                        'template' => '{view} {certificate} {set-expert} {send-for-report}',
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
                            },
                            'certificate' => function ($url, $model) {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-book"></span>',
                                    ['certificate', 'id' => $model->id],
                                    [
                                        'title' => 'شناسنامه',
                                        'style' => 'color: green'
                                    ]
                                );
                            },
                            'set-expert' => function ($url, $model) {
                                return Html::a(
                                    '<span class="fa fa-graduation-cap"></span>',
                                    ['set-expert', 'id' => $model->id],
                                    [
                                        'title' => $model->reportExpertId ? 'تغییر کارشناس' : 'تعیین کارشناس',
                                        'data-pjax' => '0',
                                        'class' => 'ajaxupdate',
                                        'style' => 'color: green'
                                    ]
                                );
                            },
                            'send-for-report' => function ($url, $model) {
                                if (!$model->reportExpertId) {
                                    return;
                                }
                                return Html::a(
                                    '<span class="fa fa-check"></span>',
                                    [
                                        'change-status',
                                        'id' => $model->id,
                                        'newStatus' => Proposal::STATUS_IN_NEXT_STEP
                                    ],
                                    [
                                        'title' => 'ارسال برای نگارش گزارش',
                                        'data-pjax' => '0',
                                        'class' => 'ajaxupdate',
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
