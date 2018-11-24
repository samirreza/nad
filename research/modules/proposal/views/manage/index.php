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
                    ['class' => 'core\grid\IDColumn'],
                    'title',
                    'researcherName',
                    'presentationDate:date',
                    'deliverToManagerDate:date',
                    'sessionDate:dateTime',
                    [
                        'attribute' => 'expertId',
                        'headerOptions' => ['style' => 'width:300px'],
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'expertId',
                            'data' => ArrayHelper::map(
                                Expert::find()->all(),
                                'id',
                                'email'
                            ),
                            'options' => [
                                'placeholder' => 'ایمیل کارشناس را انتخاب کنید'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ]
                        ]),
                        'format' => 'raw',
                        'value' => function ($model) {
                            if (!$model->expertId) {
                                return;
                            }
                            return Html::a(
                                $model->expert->email,
                                [
                                    '/research/manage/index',
                                    'ExpertSearch[id]' => $model->expertId
                                ],
                                [
                                    'target' => '_blank',
                                    'data-pjax' => '0'
                                ]
                            );
                        }
                    ],
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
                                return Html::a(
                                    'پروژه ها',
                                    [
                                        '/research/project/manage/index',
                                        'ProjectSearch[proposalId]' => $model->id
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
