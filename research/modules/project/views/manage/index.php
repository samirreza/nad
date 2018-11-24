<?php

use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use nad\research\modules\project\models\Project;

$this->title = 'لیست پروژه ها';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="project-index">
    <?php Panel::begin(['title' => $this->title]) ?>
        <?php Pjax::begin(['id' => 'project-index-gridviewpjax']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'core\grid\IDColumn'],
                    'title',
                    'researcherName',
                    'complationDate:date',
                    'deliverToManagerDate:date',
                    'sessionDate:dateTime',
                    [
                        'attribute' => 'status',
                        'filter' => Project::getStatusLables(),
                        'value' => function ($model) {
                            return Project::getStatusLables()[$model->status];
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn']
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
