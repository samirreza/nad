<?php

use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use nad\research\modules\source\models\Source;
use nad\extensions\comment\widgets\commentList\CommentList;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'منشاها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;

?>

<a class="ajaxcreate" data-gridpjaxid="source-view-detailviewpjax"></a>
<div class="source-view">
    <?php Pjax::begin(['id' => 'source-view-detailviewpjax']) ?>
        <h2><?= $model->title . ' (' . Source::getStatusLables()[$model->status] . ')' ?></h2>
        <br>
        <?= $this->render('_action-buttons', ['model' => $model]) ?>
        <div class="sliding-form-wrapper"></div>
        <div class="row">
            <div class="col-md-6">
                <?php Panel::begin(['title' => 'مشخصات منشا']) ?>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'title',
                            [
                                'attribute' => 'createdBy',
                                'value' => function ($model) {
                                    return $model->recommender->email;
                                }
                            ],
                            'createdAt:date',
                            'reasons',
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
                                'attribute' => 'experts',
                                'value' => function ($model) {
                                    return $model->getExpertEmailsAsString();
                                }
                            ],
                            [
                                'attribute' => 'status',
                                'value' => function ($model) {
                                    return Source::getStatusLables()[$model->status];
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
                    'moduleId' => 'source',
                    'showCreateButton' => Yii::$app->user->can(
                        'research.manage'
                    ) && $model->status == Source::STATUS_MEETING_HELD
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-ms-12">
                <?php Panel::begin([
                    'title' => 'دلایل طرح موضوع'
                ]) ?>
                    <div class="well">
                        <?= $model->reason ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-ms-12">
                <?php Panel::begin([
                    'title' => 'ضرورت های طرح موضوع'
                ]) ?>
                    <div class="well">
                        <?= $model->necessity ?>
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
