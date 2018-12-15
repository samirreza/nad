<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use nad\research\modules\project\models\Project;
use nad\extensions\comment\widgets\commentList\CommentList;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'گزارش ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;

?>

<a class="ajaxcreate" data-gridpjaxid="project-view-detailviewpjax"></a>
<div class="project-view">
    <?php Pjax::begin(['id' => 'project-view-detailviewpjax']) ?>
        <h2><?= $model->title . ' (' . Project::getStatusLables()[$model->status] . ')' ?></h2>
        <br>
        <?= $this->render('_action-buttons', ['model' => $model]) ?>
        <div class="sliding-form-wrapper"></div>
        <div class="row">
            <div class="col-md-6">
                <?php Panel::begin(['title' => 'مشخصات گزارش']) ?>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'title',
                            [
                                'attribute' => 'createdBy',
                                'value' => function ($model) {
                                    return $model->researcher->email;
                                }
                            ],
                            'createdAt:date',
                            [
                                'label' => 'فایل',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return Html::a(
                                        'دانلود فایل',
                                        $model->getFile('report')->getUrl(),
                                        [
                                            'data-pjax' => '0'
                                        ]
                                    );
                                }
                            ],
                            'deliverToManagerDate:date',
                            'sessionDate:date',
                            [
                                'attribute' => 'resources',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return $model->getClickableResourcesAsString();
                                }
                            ],
                            [
                                'attribute' => 'tags',
                                'value' => function ($model) {
                                    return $model->getTagsAsString();
                                }
                            ],
                            [
                                'attribute' => 'proposalId',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return Html::a(
                                        $model->proposal->title,
                                        [
                                            '/research/proposal/manage/view',
                                            'id' => $model->proposalId
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
                                'value' => function ($model) {
                                    return Project::getStatusLables()[$model->status];
                                }
                            ],
                            'updatedAt:date'
                        ]
                    ]) ?>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-6">
                <?= CommentList::widget([
                    'model' => $model,
                    'moduleId' => 'project',
                    'showCreateButton' => Yii::$app->user->can(
                        'research.manage'
                    ) && $model->status == Project::STATUS_MEETING_HELD
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-ms-12">
                <?php Panel::begin([
                    'title' => 'چکیده'
                ]) ?>
                    <div class="well">
                        <?= $model->abstract ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-ms-12">
                <?php Panel::begin([
                    'title' => 'نتیجه برگزاری جلسه'
                ]) ?>
                    <div class="well">
                        <?= $model->proceedings ?>
                    </div>
                <?php Panel::end() ?>
            </div>
        </div>
    <?php Pjax::end() ?>
</div>
