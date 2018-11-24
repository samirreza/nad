<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use yii\helpers\ArrayHelper;
use theme\widgets\ActionButtons;
use core\widgets\select2\Select2;
use nad\research\modules\expert\models\Expert;
use nad\research\modules\source\models\Source;

$this->title = 'لیست منشاها';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="source-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'درج منشا',
                'visibleFor' => ['research.createSource']
            ]
        ]
    ]) ?>
    <?php Panel::begin(['title' => $this->title]) ?>
        <?php Pjax::begin(['id' => 'source-index-gridviewpjax']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'core\grid\IDColumn'],
                    'title',
                    'recommenderName',
                    'recommendationDate:date',
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
                                return Html::a(
                                    'پروپوزال ها',
                                    [
                                        '/research/proposal/manage/index',
                                        'ProposalSearch[sourceId]' => $model->id
                                    ]
                                );
                            }
                        ],
                        'visibleButtons' => [
                            'delete' => Yii::$app->user->canAccessAny([
                                'research.createSource',
                                'research.manageSources'
                            ]),
                            'update' => function ($model, $key, $index) {
                                return $model->status != Source::STATUS_REJECTED &&
                                    Yii::$app->user->canAccessAny([
                                        'research.createSource',
                                        'research.manageSources'
                                    ]);
                            }
                        ]
                    ]
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
