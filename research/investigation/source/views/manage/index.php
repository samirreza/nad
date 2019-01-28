<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use core\grid\GridView;
use theme\widgets\Panel;
use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use nad\office\modules\expert\models\Expert;
use nad\research\investigation\source\models\Source;
use nad\research\investigation\source\models\SourceReason;

$this->title = 'منشاها';
$this->params['breadcrumbs'] = [
    'پژوهش',
    'بررسی',
    $this->title
];

?>

<div class="source-index">
    <?php Panel::begin(['title' => $this->title]) ?>
        <?php Pjax::begin(['id' => 'source-index-gridviewpjax']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'showExportButton' => true,
                'filterUrl' => ['index'],
                'exportAction' => 'export-source-grid',
                'columns' => [
                    [
                        'class' => 'core\grid\TitleColumn',
                        'headerOptions' => ['style' => 'width:70%'],
                        'filterInputOptions' => [
                            'class' => 'form-control',
                            'placeholder' => 'جست‌و‌جو عنوان منشا'
                        ]
                    ],
                    [
                        'class' => 'nad\common\code\CodeGridColumn',
                        'isAjaxGrid' => false,
                        'options' => ['style' => 'width:5%']
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
                                Expert::getDepartmentExperts(
                                    Expert::DEPARTMENT_RESEARCH
                                ),
                                'userId',
                                'fullName'
                            ),
                            'options' => [
                                'placeholder' => 'انتخاب کارشناس'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ]
                        ])
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
                                'placeholder' => 'انتخاب علت'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ]
                        ])
                    ],
                    'createdAt:date',
                    [
                        'attribute' => 'status',
                        'value' => function ($model) {
                            return Source::getStatusLables()[$model->status];
                        },
                        'filter' => Source::getStatusLables(),
                        'options' => ['style' => 'width:10%']
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete} {certificate} {proposals}',
                        'buttons' => [
                            'certificate' => function ($url, $model, $key) {
                                return Html::a(
                                    '<span class="fa fa-book"></span>',
                                    [
                                        'certificate',
                                        'id' => $model->id
                                    ],
                                    [
                                        'title' => 'شناسنامه'
                                    ]
                                );
                            },
                            'proposals' => function ($url, $model, $key) {
                                if (Yii::$app->user->can('research.manage')) {
                                    return Html::a(
                                        'پروپوزال‌ها',
                                        [
                                            '/research/investigation/proposal/manage/index',
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
                            },
                            'certificate' => Yii::$app->user->can('research.manage')
                        ]
                    ]
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
