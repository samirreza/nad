<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use modules\user\backend\models\User;
use nad\research\modules\proposal\models\Proposal;
use nad\extensions\comment\widgets\commentList\CommentList;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'پروپوزال ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;

?>

<a class="ajaxcreate" data-gridpjaxid="proposal-view-detailviewpjax"></a>
<div class="proposal-view">
    <?php Pjax::begin(['id' => 'proposal-view-detailviewpjax']) ?>
        <h2><?= $model->title . ' (' . Proposal::getStatusLables()[$model->status] . ')' ?></h2>
        <br>
        <?= $this->render('_action-buttons', ['model' => $model]) ?>
        <div class="sliding-form-wrapper"></div>
        <div class="row">
            <div class="col-md-6">
                <?php Panel::begin(['title' => 'مشخصات پروپوزال']) ?>
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
                            'deliverToManagerDate:date',
                            'sessionDate:date',
                            [
                                'attribute' => 'tags',
                                'value' => function ($model) {
                                    return $model->getTagsAsString();
                                }
                            ],
                            [
                                'attribute' => 'resources',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return $model->getClickableResourcesAsString();
                                }
                            ],
                            [
                                'attribute' => 'sourceId',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return Html::a(
                                        $model->source->title,
                                        [
                                            '/research/source/manage/view',
                                            'id' => $model->sourceId
                                        ],
                                        [
                                            'target' => '_blank',
                                            'data-pjax' => '0'
                                        ]
                                    );
                                }
                            ],
                            [
                                'attribute' => 'expertUserId',
                                'value' => function ($model) {
                                    return User::findOne($model->expertUserId)
                                        ->email ?? null;
                                }
                            ],
                            [
                                'attribute' => 'status',
                                'value' => function ($model) {
                                    return Proposal::getStatusLables()[$model->status];
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
                    'moduleId' => 'proposal',
                    'showCreateButton' => Yii::$app->user->can(
                        'research.manage'
                    ) && $model->status == Proposal::STATUS_MEETING_HELD
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-ms-12">
                <?php Panel::begin([
                    'title' => 'ضرورت اجرای طرح'
                ]) ?>
                    <div class="well">
                        <?= $model->necessity ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-ms-12">
                <?php Panel::begin([
                    'title' => 'هدف اصلی'
                ]) ?>
                    <div class="well">
                        <?= $model->mainPurpose ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-ms-12">
                <?php Panel::begin([
                    'title' => 'هدف فرعی'
                ]) ?>
                    <div class="well">
                        <?= $model->secondaryPurpose ?>
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
