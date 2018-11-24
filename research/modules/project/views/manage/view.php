<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use theme\widgets\ActionButtons;
use nad\research\modules\project\models\Project;
use nad\extensions\comment\widgets\commentList\CommentList;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'لیست پروژه ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<a class="ajaxcreate" data-gridpjaxid="project-view-detailviewpjax"></a>
<div class="project-view">
    <?php Pjax::begin(['id' => 'project-view-detailviewpjax']) ?>
        <?= ActionButtons::widget([
            'buttons' => [
                'deliver-to-manager' => [
                    'label' => 'ارسال به مدیر',
                    'icon' => 'send',
                    'type' => 'info',
                    'visibleFor' => ['expert'],
                    'visible' => $model->status == Project::STATUS_INPROGRESS ||
                        $model->status == Project::STATUS_NEED_CORRECTION,
                    'url' => ['deliver-to-manager', 'id' => $model->id],
                    'options' => [
                        'class' => 'ajaxrequest'
                    ]
                ],
                'set-session-date' => [
                    'label' => 'تعیین زمان جلسه توجیحی',
                    'icon' => 'clock-o',
                    'type' => 'info',
                    'visibleFor' => ['research.manageProject'],
                    'visible' => $model->status == Project::STATUS_DELIVERED_TO_MANAGER ||
                        $model->status == Project::STATUS_WAITING_FOR_MEETING,
                    'url' => ['set-session-date', 'id' => $model->id],
                    'options' => [
                        'class' => 'ajaxupdate'
                    ]
                ],
                'meeting-held' => [
                    'label' => 'جلسه برگزار شد',
                    'icon' => 'check',
                    'type' => 'info',
                    'visibleFor' => ['research.manageProject'],
                    'visible' => $model->status == Project::STATUS_WAITING_FOR_MEETING,
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Project::STATUS_MEETING_HELD
                    ],
                    'options' => [
                        'class' => 'ajaxrequest'
                    ]
                ],
                'write-proceedings' => [
                    'label' => 'ثبت صورت جلسه',
                    'icon' => 'file-word-o',
                    'type' => 'info',
                    'visibleFor' => ['research.manageProject'],
                    'visible' => $model->status == Project::STATUS_MEETING_HELD,
                    'url' => ['write-proceedings', 'id' => $model->id],
                    'options' => [
                        'class' => 'ajaxupdate'
                    ]
                ],
                'accept' => [
                    'label' => 'تایید',
                    'icon' => 'check',
                    'type' => 'info',
                    'visibleFor' => ['research.manageProject'],
                    'visible' => $model->status == Project::STATUS_MEETING_HELD,
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Project::STATUS_ACCEPTED
                    ],
                    'options' => [
                        'class' => 'ajaxrequest'
                    ]
                ],
                'need-correction' => [
                    'label' => 'نیازمند اصلاح',
                    'icon' => 'refresh',
                    'type' => 'info',
                    'visibleFor' => ['research.manageProject'],
                    'visible' => $model->status == Project::STATUS_MEETING_HELD,
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Project::STATUS_NEED_CORRECTION
                    ],
                    'options' => [
                        'class' => 'ajaxrequest'
                    ]
                ],
                'archive' => [
                    'label' => 'آرشیو کردن',
                    'icon' => 'clone',
                    'type' => 'success',
                    'visibleFor' => ['research.manageProject'],
                    'visible' => $model->status == Project::STATUS_ACCEPTED,
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Project::STATUS_ARCHIVED
                    ],
                    'options' => [
                        'class' => 'ajaxrequest'
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
                    'visible' => $model->canUserManipulateProject()
                ],
                'delete' => [
                    'label' => 'حذف',
                    'visible' => $model->canUserManipulateProject()
                ],
                'index' => ['label' => 'لیست پروژه ها']
            ]
        ]) ?>
        <div class="sliding-form-wrapper"></div>
        <div class="row">
            <div class="col-md-6">
                <?php Panel::begin(['title' => 'مشخصات پروژه']) ?>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id:farsiNumber',
                            'title',
                            'researcherName',
                            'complationDate:date',
                            'deliverToManagerDate:boolean',
                            'sessionDate:dateTime',
                            [
                                'attribute' => 'status',
                                'value' => function ($model) {
                                    return Project::getStatusLables()[$model->status];
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
                            'createdAt:dateTime',
                            'updatedAt:dateTime'
                        ]
                    ]) ?>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-6">
                <?= CommentList::widget([
                    'model' => $model,
                    'moduleId' => 'project',
                    'showCreateButton' => Yii::$app->user->can(
                        'research.manageProject'
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
