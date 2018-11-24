<?php

use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use theme\widgets\ActionButtons;
use nad\research\modules\source\models\Source;
use nad\extensions\comment\widgets\commentList\CommentList;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'لیست منشاها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<a class="ajaxcreate" data-gridpjaxid="source-view-detailviewpjax"></a>
<div class="source-view">
    <?php Pjax::begin(['id' => 'source-view-detailviewpjax']) ?>
        <?= $this->render('@nad/research/common/views/base-action-buttons', [
            'model' => $model,
            'managerPermission' => ['research.manageSources'],
            'deliverToManagerPermission' => ['research.createSource']
        ]) ?>
        <?= ActionButtons::widget([
            'visibleFor' => ['research.manageSources'],
            'buttons' => [
                'reject' => [
                    'label' => 'رد',
                    'icon' => 'times',
                    'type' => 'danger',
                    'visible' => $model->status == Source::STATUS_MEETING_HELD,
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Source::STATUS_REJECTED
                    ],
                    'options' => [
                        'class' => 'ajaxrequest'
                    ]
                ],
                'set-expert' => [
                    'label' => 'تعیین کارشناس',
                    'icon' => 'graduation-cap',
                    'type' => 'info',
                    'visible' => $model->status == Source::STATUS_ACCEPTED,
                    'url' => ['set-expert', 'id' => $model->id],
                    'options' => [
                        'class' => 'ajaxupdate'
                    ]
                ],
                'send-for-proposal' => [
                    'label' => 'ارسال برای نگارش پروپوزال',
                    'icon' => 'clone',
                    'type' => 'success',
                    'visible' => $model->status == Source::STATUS_ACCEPTED &&
                        $model->expertId,
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Source::STATUS_READY_FOR_PROPOSAL
                    ],
                    'options' => [
                        'class' => 'ajaxrequest'
                    ]
                ],
                'create-proposal' => [
                    'label' => 'درج پروپوزال',
                    'icon' => 'plus',
                    'type' => 'success',
                    'visibleFor' => ['expert'],
                    'visible' => $model->status == Source::STATUS_READY_FOR_PROPOSAL,
                    'url' => [
                        '/research/proposal/manage/create',
                        'sourceId' => $model->id
                    ]
                ]
            ]
        ]) ?>
        <?= ActionButtons::widget([
            'modelID' => $model->id,
            'buttons' => [
                'documentation' => [
                    'label' => $model->hasDocumentation() ? 'مراجع' : 'درج مرجع',
                    'icon' => 'file',
                    'type' => 'info',
                    'url' => ['documentation', 'id' => $model->id]
                ],
                'update' => [
                    'label' => 'ویرایش',
                    'visibleFor' => [
                        'research.createSource',
                        'research.manageSources'
                    ],
                    'visible' => $model->status != Source::STATUS_REJECTED
                ],
                'delete' => [
                    'label' => 'حذف',
                    'visibleFor' => [
                        'research.createSource',
                        'research.manageSources'
                    ]
                ],
                'create' => [
                    'label' => 'درج منشا',
                    'visibleFor' => ['research.createSource']
                ],
                'index' => ['label' => 'لیست منشاها']
            ]
        ]) ?>
        <div class="sliding-form-wrapper"></div>
        <div class="row">
            <div class="col-md-6">
                <?php Panel::begin(['title' => 'مشخصات منشا']) ?>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id:farsiNumber',
                            'title',
                            'recommenderName',
                            'recommendationDate:date',
                            'reasons',
                            'deliverToManagerDate:boolean',
                            'sessionDate:dateTime',
                            [
                                'attribute' => 'expertId',
                                'value' => function ($model) {
                                    if (!$model->expertId) {
                                        return;
                                    }
                                    return $model->expert->email;
                                }
                            ],
                            [
                                'attribute' => 'status',
                                'value' => function ($model) {
                                    return Source::getStatusLables()[$model->status];
                                }
                            ],
                            [
                                'attribute' => 'tags',
                                'value' => function ($model) {
                                    return $model->getTagsAsString();
                                }
                            ],
                            'createdAt:dateTime',
                            'updatedAt:dateTime'
                        ]
                    ]) ?>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-6">
                <?= CommentList::widget([
                    'model' => $model,
                    'moduleId' => 'source',
                    'showCreateButton' => Yii::$app->user->can(
                        'research.manageSources'
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
                    'title' => 'صورت جلسه'
                ]) ?>
                    <div class="well">
                        <?= $model->proceedings ?>
                    </div>
                <?php Panel::end() ?>
            </div>
        </div>
    <?php Pjax::end() ?>
</div>
