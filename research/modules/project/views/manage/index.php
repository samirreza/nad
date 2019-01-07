<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use yii\helpers\ArrayHelper;
use theme\widgets\ActionButtons;
use core\widgets\select2\Select2;
use nad\office\modules\expert\models\Expert;
use nad\research\modules\project\models\Project;

$this->title = 'گزارش ها';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="project-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'categoriesIndex' => [
                'label' => 'رده های گزارش ها',
                'icon' => 'sitemap',
                'visibleFor' => ['research.manage']
            ]
        ]
    ]) ?>
    <?php Panel::begin(['title' => $this->title]) ?>
        <?php Pjax::begin(['id' => 'project-index-gridviewpjax']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'core\grid\TitleColumn',
                        'headerOptions' => ['style' => 'width:30%'],
                        'filterInputOptions' => [
                            'class'       => 'form-control',
                            'placeholder' => 'جست‌و‌جو عنوان گزارش'
                        ]
                    ],
                    [
                        'class' => 'nad\common\code\CodeGridColumn',
                        'isAjaxGrid' => false,
                        'options' => ['style' => 'width:10%']
                    ],
                    [
                        'attribute' => 'category.title',
                        'header' => 'زیر شاخه',
                        'value' => function ($model) {
                            return $model->category->familyTreeTitle;
                        },
                        'headerOptions' => ['style' => 'width:20%'],
                        'filterInputOptions' => [
                            'class'       => 'form-control',
                            'placeholder' => 'جست‌و‌جو زیر‌شاخه گزارش'
                        ]
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
                    'createdAt:date',
                    [
                        'attribute' => 'status',
                        'filter' => Project::getStatusLables(),
                        'value' => function ($model) {
                            return Project::getStatusLables()[$model->status];
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete} {certificate}',
                        'buttons' => [
                            'certificate' => function ($url, $model, $key) {
                                return Html::a(
                                    '<span class="fa fa-book"></span>',
                                    [
                                        '/research/project/manage/certificate',
                                        'id' => $model->id
                                    ],
                                    [
                                        'title' => 'شناسنامه'
                                    ]
                                );
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
