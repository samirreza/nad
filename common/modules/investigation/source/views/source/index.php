<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use core\grid\GridView;
use theme\widgets\Panel;
use yii\helpers\ArrayHelper;
use theme\widgets\ActionButtons;
use core\widgets\select2\Select2;
use nad\office\modules\expert\models\Expert;
use nad\common\modules\investigation\source\models\Source;
use nad\common\modules\investigation\source\models\SourceReason;

?>

<h2 class="nad-page-title">منشاهای برنامه</h2>
<div class="sliding-form-wrapper"></div>
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
                            'placeholder' => 'جست‌و‌جو شناسه'
                        ],
                        'options' => [
                            'width' => '40px'
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
                    // [
                    //     'attribute' => 'createdAt',
                    //     'format' => ['date', 'Y-M-d']
                    // ],
                    [
                        'attribute' => 'status',
                        'value' => function ($model) {
                            // TODO move it to a state in "Source::getUserHolderLables()"
                            if($model->hasAnyExpert() && $model->status == Source::STATUS_ACCEPTED){
                                return 'منتظر ارسال جهت نگارش پروپوزال';
                            }
                            return Source::getStatusLables()[$model->status];
                        },
                        'filter' => Source::getStatusLables(),
                        'options' => [
                            'width' => '150px'
                        ]
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'دسترسی',
                        'template' => '{view} {certificate} {set-experts} {send-for-proposal}',
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
                            'set-experts' => function ($url, $model) {
                                return Html::a(
                                    '<span class="fa fa-graduation-cap"></span>',
                                    ['set-experts', 'id' => $model->id],
                                    [
                                        'title' => $model->hasAnyExpert() ? 'تغییر کارشناسان' : 'تعیین کارشناسان',
                                        'data-pjax' => '0',
                                        'class' => 'ajaxupdate',
                                        'style' => 'color: green'
                                    ]
                                );
                            },
                            'send-for-proposal' => function ($url, $model) {
                                if (!$model->hasAnyExpert()) {
                                    return;
                                }
                                return Html::a(
                                    '<span class="fa fa-check"></span>',
                                    [
                                        'change-status',
                                        'id' => $model->id,
                                        'newStatus' => Source::STATUS_IN_NEXT_STEP
                                    ],
                                    [
                                        'title' => 'ارسال برای نگارش پروپوزال',
                                        'data-pjax' => '0',
                                        'class' => 'ajaxupdate',
                                        'style' => 'color: green'
                                    ]
                                );
                            },
                        ],
                        'visibleButtons' => [
                            'set-experts' => $searchModel->status == Source::STATUS_ACCEPTED &&
                                Yii::$app->user->isSuperuser(),
                            'send-for-proposal' => $searchModel->status == Source::STATUS_ACCEPTED &&
                                Yii::$app->user->isSuperuser()
                        ]
                    ]
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
