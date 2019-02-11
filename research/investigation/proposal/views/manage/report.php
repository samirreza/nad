<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use nad\research\investigation\proposal\models\Proposal;

$this->title = 'گزارش ساز پروپوزال';
$this->params['breadcrumbs'] = [
    'پژوهش',
    'گزارش‌های مدیریتی',
    $this->title
];

?>

<div class="proposal-manager-index">
    <?= $this->render('_report_search', ['model' => $searchModel]) ?>
    <?php Panel::begin(['title' => '']) ?>
        <?php Pjax::begin(['id' => 'proposal-index-gridviewpjax']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'class' => 'core\grid\TitleColumn',
                        'headerOptions' => ['style' => 'width:80%'],
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
                        'headerOptions' => ['style' => 'width:10%']
                    ],
                    [
                        'attribute' => 'createdAt',
                        'value' => function ($model) {
                            return Yii::$app->formatter->asDate($model->createdAt, 'Y-M-d');
                        }
                    ],
                    [
                        'attribute' => 'status',
                        'value' => function ($model) {
                            return Proposal::getStatusLables()[$model->status];
                        },
                        'options' => ['style' => 'width:10%']
                    ],
                    [
                        'class' => 'core\grid\ActionColumn',
                        'template' => '{view} {projects}',
                        'buttons' => [
                            'projects' => function ($url, $model, $key) {
                                return Html::a(
                                    'گزارش‌ها',
                                    [
                                        '/research/investigation/project/manage/index',
                                        'ProjectSearch[proposalId]' => $model->id
                                    ],
                                    [
                                        'data-pjax' => 0,
                                        'target' => '_blank'
                                    ]
                                );
                            }
                        ],
                        'buttonOptions' => [
                            'data-pjax' => 0,
                            'target' => '_blank'
                        ]
                    ]
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
