<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use yii\helpers\ArrayHelper;
use theme\widgets\ActionButtons;
use core\widgets\select2\Select2;
use nad\office\modules\expert\models\Expert;
use nad\research\modules\source\models\Source;
use nad\research\modules\source\models\SourceReason;

$this->title = 'منشاها';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="source-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'درج منشا'
            ]
        ]
    ]) ?>
    <?php Panel::begin(['title' => $this->title]) ?>
        <?php Pjax::begin(['id' => 'source-index-gridviewpjax']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'core\grid\TitleColumn',
                        'headerOptions' => ['style' => 'width:30%']
                    ],
                    [
                        'class' => 'nad\common\code\CodeGridColumn',
                        'isAjaxGrid' => false,
                        'options' => ['style' => 'width:10%']
                    ],
                    [
                        'attribute' => 'createdBy',
                        'value' => function ($model) {
                            return $model->researcher->email;
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'createdBy',
                            'data' => ArrayHelper::map(
                                Expert::getDepartmentExperts(
                                    Expert::DEPARTMENT_RESEARCH
                                ),
                                'userId',
                                'email'
                            ),
                            'options' => [
                                'placeholder' => 'ایمیل کارشناس را انتخاب کنید'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ]
                        ]),
                        'headerOptions' => ['style' => 'width:20%']
                    ],
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
                                'placeholder' => 'علت را انتخاب کنید'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ]
                        ]),
                        'headerOptions' => ['style' => 'width:15%']
                    ],
                    'createdAt:date',
                    [
                        'attribute' => 'status',
                        'filter' => Source::getStatusLables(),
                        'value' => function ($model) {
                            return Source::getStatusLables()[$model->status];
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete} {proposals}',
                        'buttons' => [
                            'proposals' => function ($url, $model, $key) {
                                if (Yii::$app->user->can('research.manage')) {
                                    return Html::a(
                                        'پروپوزال ها',
                                        [
                                            '/research/proposal/manage/index',
                                            'ProposalSearch[sourceId]' => $model->id
                                        ]
                                    );
                                }
                            }
                        ],
                        'visibleButtons' => [
                            'view' => Yii::$app->user->canAccessAny([
                                'research.expert',
                                'research.manage'
                            ]),
                            'update' => function ($model, $key, $index) {
                                return $model->canUserUpdateOrDelete();
                            },
                            'delete' => function ($model, $key, $index) {
                                return $model->canUserUpdateOrDelete();
                            }
                        ]
                    ]
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
