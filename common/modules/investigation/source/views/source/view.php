<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use theme\widgets\ActionButtons;
use nad\common\modules\investigation\source\models\Source;
use nad\extensions\comment\widgets\commentList\CommentList;

?>

<a class="ajaxcreate" data-gridpjaxid="source-view-detailview-pjax"></a>
<div class="source-view">
    <?php Pjax::begin(['id' => 'source-view-detailview-pjax']) ?>
        <?= ActionButtons::widget([
            'modelID' => $model->id,
            'buttons' => [
                'update' => [
                    'type' => 'warning',
                    'isActive' => $model->canUserUpdateOrDelete()
                ],
                'delete' => [
                    'type' => 'warning',
                    'isActive' => $model->canUserUpdateOrDelete()
                ],
                'send-to' => [
                    'isDropDown' => true,
                    'label' => '&nbsp;&nbsp;&nbsp;ارسال&nbsp;&nbsp;&nbsp;',
                    'type' => 'info',
                    'icon' => 'send',
                    'isActive' => (($model->canUserDeliverToManager() && !Yii::$app->user->can('superuser')) || ($model->canAcceptOrRejectOrCorrect() && Yii::$app->user->can('superuser')) || ($model->status == Source::STATUS_ACCEPTED &&
                    $model->hasAnyExpert() && Yii::$app->user->can('superuser'))),
                    'items' => [
                        'send-to-manager' => [
                            'label' => 'به مدیر',
                            'url' => ['deliver-to-manager', 'id' => $model->id],
                            'icon' => 'reply',
                            'isActive' => $model->canUserDeliverToManager(),
                            'visible' => true
                        ],
                        'send-to-expert' => [
                            'label' => 'به کارشناس',
                            'icon' => 'reply',
                            'isActive' => $model->canAcceptOrRejectOrCorrect() && Yii::$app->user->can('superuser') ,
                            'visible' => true,
                            'url' => [
                                'change-status',
                                'id' => $model->id,
                                'newStatus' => Source::STATUS_NEED_CORRECTION
                            ]
                        ],
                        'send-for-proposal' => [
                            'label' => 'نگارش پروپوزال',
                            'icon' => 'reply',
                            'isActive' => $model->status == Source::STATUS_ACCEPTED &&
                                $model->hasAnyExpert() && Yii::$app->user->can('superuser'),
                            'visible' => true,
                            'url' => [
                                'change-status',
                                'id' => $model->id,
                                'newStatus' => Source::STATUS_IN_NEXT_STEP
                            ]
                        ],
                        'send-to-archive' => [
                            'label' => 'به بایگانی',
                            'icon' => 'reply',
                            'isActive' => Yii::$app->user->can('superuser') ,
                            'visible' => true,
                            'url' => [
                                'change-archive',
                                'id' => $model->id,
                                'newStatus' => Source::IS_SOURCE_ARCHIVED_YES
                            ]
                        ],
                    ]
                ],
                'session' => [
                    'isDropDown' => true,
                    'label' => '&nbsp;&nbsp;&nbsp;جلسه&nbsp;&nbsp;&nbsp;',
                    'type' => 'info',
                    'icon' => 'bank',
                    'isActive' => (Yii::$app->user->can('superuser') && (($model->status == Source::STATUS_IN_MANAGER_HAND) || ($model->canSetSessionDate()) || $model->canWriteProceedings())),
                    'items' => [
                        'wait-for-session' => [
                            'label' => 'نیازمند جلسه',
                            'icon' => 'bank',
                            'isActive' => $model->status == Source::STATUS_IN_MANAGER_HAND &&
                            Yii::$app->user->can('superuser'),
                            'visible' => true,
                            'url' => [
                                'change-status',
                                'id' => $model->id,
                                'newStatus' => Source::STATUS_WAITING_FOR_SESSION
                            ]
                        ],
                        'set-session-date' => [
                            'label' => 'تعیین زمان جلسه',
                            'icon' => 'clock-o',
                            'isActive' => $model->canSetSessionDate() &&
                            Yii::$app->user->can('superuser'),
                            'visible' => true,
                            'url' => ['set-session-date', 'id' => $model->id],
                            'options' => ['class' => 'ajaxupdate']
                        ],
                        'write-proceedings' => [
                            'label' => 'ثبت نتیجه جلسه',
                            'icon' => 'newspaper-o',
                            'isActive' => $model->canWriteProceedings() &&
                            Yii::$app->user->can('superuser'),
                            'visible' => true,
                            'url' => ['write-proceedings', 'id' => $model->id],
                            'options' => ['class' => 'ajaxupdate']
                        ],
                    ]
                ],
                // TODO remove wait-for-negotiation asap.
                // 'wait-for-negotiation' => [
                //     'label' => 'مذاکره',
                //     'type' => 'info',
                //     'icon' => 'handshake-o',
                //     'visible' => $model->status == Source::STATUS_IN_MANAGER_HAND,
                //     'visibleFor' => ['superuser'],
                //     'url' => [
                //         'change-status',
                //         'id' => $model->id,
                //         'newStatus' => Source::STATUS_WAIT_FOR_NEGOTIATION
                //     ]
                // ],
                'wait-for-converstation' => [
                    'label' => 'تبادل نظر',
                    'type' => 'info',
                    'icon' => 'comments',
                    'isActive' => $model->status == Source::STATUS_IN_MANAGER_HAND &&
                        Yii::$app->user->can('superuser'),
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Source::STATUS_WAIT_FOR_CONVERSATION
                    ]
                ],
                // TODO remove write-negotiation-result asap.
                // 'write-negotiation-result' => [
                //     'label' => 'ثبت نتیجه مذاکره',
                //     'type' => 'info',
                //     'icon' => 'newspaper-o',
                //     'visible' => $model->canWriteNegotiationResult(),
                //     'visibleFor' => ['superuser'],
                //     'url' => ['write-negotiation-result', 'id' => $model->id],
                //     'options' => ['class' => 'ajaxupdate']
                // ],
                'accept' => [
                    'label' => 'تایید',
                    'type' => 'info',
                    'icon' => 'check',
                    'isActive' => $model->canAcceptOrRejectOrCorrect() &&
                    Yii::$app->user->can('superuser'),
                    // 'visibleFor' => ['superuser'],
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Source::STATUS_ACCEPTED
                    ]
                ],
                'reject' => [
                    'label' => 'رد',
                    'type' => 'info',
                    'icon' => 'close',
                    'isActive' => $model->canAcceptOrRejectOrCorrect() &&
                    Yii::$app->user->can('superuser'),
                    // 'visibleFor' => ['superuser'],
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Source::STATUS_REJECTED
                    ]
                ],
                'set-experts' => [
                    'label' => $model->hasAnyExpert() ? 'تغییر کارشناس' : 'انتخاب کارشناس',
                    'type' => 'info',
                    'icon' => 'graduation-cap',
                    'isActive' => $model->status == Source::STATUS_ACCEPTED &&
                    Yii::$app->user->can('superuser'),
                    // 'visibleFor' => ['superuser'],
                    'url' => ['set-experts', 'id' => $model->id],
                    'options' => ['class' => 'ajaxupdate']
                ],
                'create-proposal' => [
                    'label' => 'درج پروپوزال',
                    'type' => 'info',
                    'icon' => 'plus',
                    'isActive' => $model->canUserCreateProposal(),
                    'url' => [
                        $creatProposalRoute,
                        'sourceId' => $model->id
                    ]
                ]
            ]
        ]) ?>
        <div class="sliding-form-wrapper"></div>
        <?php if ($model->canHaveConverstation()) : ?>
            <div class="col-md-12">
                <?= CommentList::widget([
                    'model' => $model,
                    'moduleId' => $moduleId,
                    'returnUrl' => Url::current()
                ]) ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <?php Panel::begin(['title' => 'مشخصات منشا']) ?>
                    <div class="col-md-6">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'title',
                                'englishTitle',
                                'uniqueCode',
                                [
                                    'attribute' => 'createdBy',
                                    'value' => function ($model) {
                                        return $model->researcherTitle;
                                    }
                                ],
                                'createdAt:date',
                                [
                                    'attribute' => 'mainReasonId',
                                    'value' => function ($model) {
                                        return $model->mainReason->title;
                                    }
                                ],
                                // TODO remove 'reasons' asap
                                //'reasons',
                                [
                                    'attribute' => 'references',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return $model->getClickableReferencesAsString();
                                    }
                                ],
                                [
                                    'attribute' => 'tags',
                                    'value' => function ($model) {
                                        return $model->getTagsAsString();
                                    }
                                ]
                            ]
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'deliverToManagerDate:date',
                                'sessionDate:dateTime',
                                'updatedAt:date',
                                [
                                    'attribute' => 'status',
                                    'value' => function ($model) {
                                        return Source::getStatusLables()[$model->status];
                                    }
                                ],
                                [
                                    'attribute' => 'experts',
                                    'value' => function ($model) {
                                        return $model->getExpertFullNamesAsString();
                                    }
                                ]
                            ]
                        ]) ?>
                    </div>
                <?php Panel::end() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php Panel::begin(['title' => 'سابقه پیدایش']) ?>
                    <div class="well">
                        <?= $model->reasonForGenesis ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-12">
                <?php Panel::begin(['title' => 'شرح عنوان']) ?>
                    <div class="well">
                        <?= $model->necessity ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <?php if ($model->proceedings) : ?>
                <div class="col-md-12">
                    <?php Panel::begin(['title' => 'نتیجه جلسه']) ?>
                        <div class="well">
                            <?= $model->proceedings ?>
                        </div>
                    <?php Panel::end() ?>
                </div>
            <?php endif; ?>
            <?php if ($model->status != Source::STATUS_WAIT_FOR_CONVERSATION && $model->comments) : ?>
                <div class="col-md-12">
                    <?= CommentList::widget([
                        'model' => $model,
                        'moduleId' => $moduleId,
                        'showCreateButton' => false,
                        'showEditDeleteButton' => false
                    ]) ?>
                </div>
            <?php endif; ?>
        </div>
    <?php Pjax::end() ?>
</div>
