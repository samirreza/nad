<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use nad\research\modules\expert\models\Expert;
use nad\research\modules\proposal\models\Proposal;

$this->title = 'لیست پروپوزال ها';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="proposal-index">
    <?php Panel::begin(['title' => $this->title]) ?>
        <?php Pjax::begin(['id' => 'proposal-index-gridviewpjax']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'title',
                    [
                        'attribute' => 'createdBy',
                        'headerOptions' => ['style' => 'width:300px'],
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'createdBy',
                            'data' => ArrayHelper::map(
                                Expert::find()->all(),
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
                        'value' => function ($model) {
                            return $model->researcher->email;
                        }
                    ],
                    'createdAt:date',
                    'deliverToManagerDate:date',
                    'sessionDate:date',
                    [
                        'attribute' => 'status',
                        'filter' => Proposal::getStatusLables(),
                        'value' => function ($model) {
                            return Proposal::getStatusLables()[$model->status];
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete} {projects}',
                        'buttons' => [
                            'projects' => function ($url, $model, $key) {
                                if (Yii::$app->user->can('research.manage')) {
                                    return Html::a(
                                        'گزارش ها',
                                        [
                                            '/research/project/manage/index',
                                            'ProjectSearch[proposalId]' => $model->id
                                        ]
                                    );
                                }
                            }
                        ],
                        'visibleButtons' => [
                            'view' => Yii::$app->user->canAccessAny([
                                'expert',
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
