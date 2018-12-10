<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use nad\research\modules\proposal\models\Proposal;

$this->title = 'گزارش ساز پروپوزال';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="proposal-manager-index">
    <?= $this->render('_report_search', ['model' => $searchModel]) ?>
    <?php Panel::begin(['title' => '']) ?>
        <?php Pjax::begin(['id' => 'proposal-index-gridviewpjax']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'title',
                    [
                        'attribute' => 'createdBy',
                        'value' => function ($model) {
                            return $model->researcher->email;
                        }
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
                                    'گزارش ها',
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
