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
        <?= ActionButtons::widget([
            'modelID' => $model->id,
            'buttons' => [
                'documentation' => [
                    'label' => $model->hasDocumentation() ? 'مستندات' : 'درج مستندات',
                    'icon' => 'file',
                    'type' => 'info',
                    'url' => ['documentation', 'id' => $model->id]
                ],
                'deliver-to-manager' => [
                    'label' => 'ارسال به مدیر',
                    'icon' => 'send',
                    'type' => 'info',
                    'visible' => $model->status == Source::STATUS_INPROGRESS ||
                        $model->status == Source::STATUS_NEED_CORRECTION,
                    'url' => ['deliver-to-manager', 'id' => $model->id],
                    'options' => [
                        'class' => 'ajaxrequest'
                    ]
                ],
                'set-session-date' => [
                    'label' => 'تعیین زمان جلسه توجیحی',
                    'icon' => 'clock-o',
                    'type' => 'info',
                    'visibleFor' => ['research.manageSource'],
                    'visible' => $model->status == Source::STATUS_DELIVERED_TO_MANAGER ||
                        $model->status == Source::STATUS_WAITING_FOR_MEETING,
                    'url' => ['set-session-date', 'id' => $model->id],
                    'options' => [
                        'class' => 'ajaxupdate'
                    ]
                ],
                'meeting-held' => [
                    'label' => 'جلسه برگزار شد',
                    'icon' => 'check',
                    'type' => 'info',
                    'visibleFor' => ['research.manageSource'],
                    'visible' => $model->status == Source::STATUS_WAITING_FOR_MEETING,
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Source::STATUS_MEETING_HELD
                    ],
                    'options' => [
                        'class' => 'ajaxrequest'
                    ]
                ],
                'accept' => [
                    'label' => 'تایید منشا',
                    'icon' => 'check',
                    'type' => 'info',
                    'visibleFor' => ['research.manageSource'],
                    'visible' => $model->status == Source::STATUS_MEETING_HELD,
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Source::STATUS_ACCEPTED
                    ],
                    'options' => [
                        'class' => 'ajaxrequest'
                    ]
                ],
                'need-correction' => [
                    'label' => 'نیازمند اصلاح',
                    'icon' => 'refresh',
                    'type' => 'info',
                    'visibleFor' => ['research.manageSource'],
                    'visible' => $model->status == Source::STATUS_MEETING_HELD,
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Source::STATUS_NEED_CORRECTION
                    ],
                    'options' => [
                        'class' => 'ajaxrequest'
                    ]
                ],
                'reject' => [
                    'label' => 'رد منشا',
                    'icon' => 'times',
                    'type' => 'info',
                    'visibleFor' => ['research.manageSource'],
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
                    'visibleFor' => ['research.manageSource'],
                    'visible' => $model->status == Source::STATUS_ACCEPTED,
                    'url' => ['set-expert', 'id' => $model->id],
                    'options' => [
                        'class' => 'ajaxupdate'
                    ]
                ],
                'create-proposal' => [
                    'label' => 'تهیه پروپوزال',
                    'icon' => 'clone',
                    'type' => 'info',
                    'visibleFor' => ['research.manageSource'],
                    'visible' => $model->status == Source::STATUS_ACCEPTED,
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Source::STATUS_CREATE_PROPOSAL
                    ],
                    'options' => [
                        'class' => 'ajaxrequest'
                    ]
                ],
                'update' => [
                    'label' => 'ویرایش',
                    'visibleFor' => ['research.manageSource']
                ],
                'delete' => [
                    'label' => 'حذف',
                    'visibleFor' => ['research.manageSource']
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
                        'research.manageSource'
                    ) && $model->status == Source::STATUS_MEETING_HELD
                ]) ?>
            </div>
        </div>
    <?php Pjax::end() ?>
</div>
