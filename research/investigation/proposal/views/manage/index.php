<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use nad\office\modules\expert\models\Expert;
use nad\research\investigation\proposal\models\Proposal;

$this->title = 'پروپوزال‌ها';
$this->params['breadcrumbs'] = [
    'پژوهش',
    'بررسی',
    $this->title
];

?>

<div class="proposal-index">
    <?php Panel::begin(['title' => $this->title]) ?>
        <?php Pjax::begin(['id' => 'proposal-index-gridviewpjax']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'core\grid\TitleColumn',
                        'headerOptions' => ['style' => 'width:80%'],
                        'filterInputOptions' => [
                            'class'       => 'form-control',
                            'placeholder' => 'جست‌و‌جو عنوان پروپوزال'
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
                                'placeholder' => 'کارشناس را انتخاب کنید'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ]
                        ])
                    ],
                    'createdAt:date',
                    [
                        'attribute' => 'status',
                        'filter' => Proposal::getStatusLables(),
                        'value' => function ($model) {
                            return Proposal::getStatusLables()[$model->status];
                        },
                        'options' => ['style' => 'width:10%']
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete} {certificate} {projects}',
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
                            'projects' => function ($url, $model, $key) {
                                if (Yii::$app->user->can('research.manage')) {
                                    return Html::a(
                                        'گزارش‌ها',
                                        [
                                            '/research/investigation/project/manage/index',
                                            'ProjectSearch[proposalId]' => $model->id
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
