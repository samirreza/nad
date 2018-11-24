<?php

use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use theme\widgets\ActionButtons;
use nad\research\modules\proposal\models\Proposal;
use nad\extensions\comment\widgets\commentList\CommentList;
use yii\helpers\Html;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'لیست پروپوژال ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<a class="ajaxcreate" data-gridpjaxid="proposal-view-detailviewpjax"></a>
<div class="proposal-view">
    <?php Pjax::begin(['id' => 'proposal-view-detailviewpjax']) ?>
        <?= ActionButtons::widget([
            'buttons' => [
                'deliver-to-manager' => [
                    'label' => 'ارسال به مدیر',
                    'icon' => 'send',
                    'type' => 'info',
                    'visibleFor' => ['expert'],
                    'visible' => $model->status == Proposal::STATUS_INPROGRESS ||
                        $model->status == Proposal::STATUS_NEED_CORRECTION,
                    'url' => ['deliver-to-manager', 'id' => $model->id],
                    'options' => [
                        'class' => 'ajaxrequest'
                    ]
                ],
                'set-session-date' => [
                    'label' => 'تعیین زمان جلسه توجیحی',
                    'icon' => 'clock-o',
                    'type' => 'info',
                    'visibleFor' => ['research.manageProposals'],
                    'visible' => $model->status == Proposal::STATUS_DELIVERED_TO_MANAGER ||
                        $model->status == Proposal::STATUS_WAITING_FOR_MEETING,
                    'url' => ['set-session-date', 'id' => $model->id],
                    'options' => [
                        'class' => 'ajaxupdate'
                    ]
                ],
                'meeting-held' => [
                    'label' => 'جلسه برگزار شد',
                    'icon' => 'check',
                    'type' => 'info',
                    'visibleFor' => ['research.manageProposals'],
                    'visible' => $model->status == Proposal::STATUS_WAITING_FOR_MEETING,
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Proposal::STATUS_MEETING_HELD
                    ],
                    'options' => [
                        'class' => 'ajaxrequest'
                    ]
                ],
                'write-proceedings' => [
                    'label' => 'ثبت صورت جلسه',
                    'icon' => 'file-word-o',
                    'type' => 'info',
                    'visibleFor' => ['research.manageProposals'],
                    'visible' => $model->status == Proposal::STATUS_MEETING_HELD,
                    'url' => ['write-proceedings', 'id' => $model->id],
                    'options' => [
                        'class' => 'ajaxupdate'
                    ]
                ],
                'accept' => [
                    'label' => 'تایید',
                    'icon' => 'check',
                    'type' => 'info',
                    'visibleFor' => ['research.manageProposals'],
                    'visible' => $model->status == Proposal::STATUS_MEETING_HELD,
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Proposal::STATUS_ACCEPTED
                    ],
                    'options' => [
                        'class' => 'ajaxrequest'
                    ]
                ],
                'need-correction' => [
                    'label' => 'نیازمند اصلاح',
                    'icon' => 'refresh',
                    'type' => 'info',
                    'visibleFor' => ['research.manageProposals'],
                    'visible' => $model->status == Proposal::STATUS_MEETING_HELD,
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Proposal::STATUS_NEED_CORRECTION
                    ],
                    'options' => [
                        'class' => 'ajaxrequest'
                    ]
                ],
                'set-expert' => [
                    'label' => 'تعیین کارشناس',
                    'icon' => 'graduation-cap',
                    'type' => 'info',
                    'visibleFor' => ['research.manageProposals'],
                    'visible' => $model->status == Proposal::STATUS_ACCEPTED,
                    'url' => ['set-expert', 'id' => $model->id],
                    'options' => [
                        'class' => 'ajaxupdate'
                    ]
                ],
                'send-for-project' => [
                    'label' => 'ارسال برای تهیه پروژه',
                    'icon' => 'clone',
                    'type' => 'success',
                    'visibleFor' => ['research.manageProposals'],
                    'visible' => $model->status == Proposal::STATUS_ACCEPTED &&
                        $model->expertId,
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Proposal::STATUS_READY_FOR_PROJECT
                    ],
                    'options' => [
                        'class' => 'ajaxrequest'
                    ]
                ],
                'create-project' => [
                    'label' => 'درج پروژه',
                    'icon' => 'plus',
                    'type' => 'success',
                    'visible' => $model->canUserCreateProject() &&
                        $model->status == Proposal::STATUS_READY_FOR_PROJECT,
                    'url' => [
                        '/research/project/manage/create',
                        'proposalId' => $model->id
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
                    'visible' => $model->canUserManipulateProposal()
                ],
                'delete' => [
                    'label' => 'حذف',
                    'visible' => $model->canUserManipulateProposal()
                ],
                'index' => ['label' => 'لیست پروپوزال ها']
            ]
        ]) ?>
        <div class="sliding-form-wrapper"></div>
        <div class="row">
            <div class="col-md-6">
                <?php Panel::begin(['title' => 'مشخصات پروپوزال']) ?>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id:farsiNumber',
                            'title',
                            'researcherName',
                            'presentationDate:date',
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
                                    return Proposal::getStatusLables()[$model->status];
                                }
                            ],
                            [
                                'attribute' => 'tags',
                                'value' => function ($model) {
                                    return $model->getTagsAsString();
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
                            'createdAt:dateTime',
                            'updatedAt:dateTime'
                        ]
                    ]) ?>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-6">
                <?= CommentList::widget([
                    'model' => $model,
                    'moduleId' => 'proposal',
                    'showCreateButton' => Yii::$app->user->can(
                        'research.manageProposals'
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
