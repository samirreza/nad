<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use nad\research\modules\proposal\models\Proposal;

$this->title = 'گزارش ساز منشا';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="source-report">
    <?= $this->render('_report_search', ['model' => $searchModel]) ?>
    <?php Panel::begin(['title' => '']) ?>
        <?php Pjax::begin() ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
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
                        'headerOptions' => ['style' => 'width:20%']
                    ],
                    'createdAt:date',
                    [
                        'attribute' => 'status',
                        'value' => function ($model) {
                            return Proposal::getStatusLables()[$model->status];
                        }
                    ],
                    [
                        'class' => 'core\grid\ActionColumn',
                        'template' => '{view} {projects}',
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-eye-open"></span>',
                                    $url,
                                    [
                                        'title' => 'نما',
                                        'data-pjax' => 0,
                                        'target' => '_blank'
                                    ]
                                );
                            },
                            'projects' => function ($url, $model, $key) {
                                return Html::a(
                                    'پروپوزال ها',
                                    [
                                        '/research/proposal/manage/index',
                                        'ProposalSearch[sourceId]' => $model->id
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
