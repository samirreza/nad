<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use theme\widgets\ActionButtons;
use nad\office\modules\expert\models\Expert;
use nad\common\modules\investigation\otherreport\models\Otherreport;
use nad\extensions\comment\widgets\commentList\CommentList;

?>

<a class="ajaxcreate" data-gridpjaxid="otherreport-view-detailview-pjax"></a>
<div class="otherreport-view">
    <?php Pjax::begin(['id' => 'otherreport-view-detailview-pjax']) ?>
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
                    'isActive' => ($model->canUserDeliverToManager() || $model->canManagerDeliverToExpert() || $model->canSendToWriteSource() || Yii::$app->user->can('superuser')),
                    'items' => [
                        'send-to-manager' => [
                            'label' => 'به مدیر',
                            'url' => ['deliver-to-manager', 'id' => $model->id],
                            'icon' => 'reply',
                            'isActive' => $model->canUserDeliverToManager(),
                            'visible' => true
                        ],
                        'send-to-expert' => [
                            'label' => 'به کارشناس جهت اصلاح',
                            'icon' => 'reply',
                            'isActive' => $model->canManagerDeliverToExpert(),
                            'visible' => true,
                            'url' => ['deliver-to-expert', 'id' => $model->id]
                        ],
                        'send-to-archive' => [
                            'label' => 'به بایگانی',
                            'icon' => 'reply',
                            'isActive' => Yii::$app->user->can('superuser') ,
                            'visible' => true,
                            'url' => [
                                'change-archive',
                                'id' => $model->id,
                                'newStatus' => Otherreport::IS_SOURCE_ARCHIVED_YES
                            ],
                            'options' => ['data-pjax' => 0]
                        ],
                    ]
                ],
                'session' => [
                    'isDropDown' => true,
                    'label' => '&nbsp;&nbsp;&nbsp;جلسه&nbsp;&nbsp;&nbsp;',
                    'type' => 'info',
                    'icon' => 'users',
                    'isActive' => ($model->canSetWaitForSession() || $model->canSetSessionDate() || $model->canWriteProceedings()),
                    'items' => [
                        'wait-for-session' => [
                            'label' => 'نیازمند جلسه',
                            'icon' => 'bank',
                            'isActive' => $model->canSetWaitForSession(),
                            'visible' => true,
                            'url' => [
                                'change-status',
                                'id' => $model->id,
                                'newStatus' => Otherreport::STATUS_WAITING_FOR_SESSION_DATE
                            ]
                        ],
                        'set-session-date' => [
                            'label' => (isset($model->sessionDate) ? 'ویرایش' : 'ثبت') . ' زمان جلسه',
                            'icon' => 'clock-o',
                            'isActive' => $model->canSetSessionDate(),
                            'visible' => true,
                            'url' => ['set-session-date', 'id' => $model->id],
                            'options' => ['class' => 'ajaxupdate']
                        ],
                        'write-proceedings' => [
                            'label' => (isset($model->proceedings) ? 'ویرایش' : 'ثبت') .  ' نتیجه جلسه',
                            'icon' => 'newspaper-o',
                            'isActive' => $model->canWriteProceedings(),
                            'visible' => true,
                            'url' => ['write-proceedings', 'id' => $model->id],
                            'options' => ['class' => 'ajaxupdate']
                        ],
                    ]
                ],
                'wait-for-converstation' => [
                    'label' => 'تبادل نظر',
                    'type' => 'info',
                    'icon' => 'comments',
                    'isActive' => $model->canStartConverstation(),
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Otherreport::STATUS_WAIT_FOR_CONVERSATION
                    ]
                ],
                // 'need-correction' => [
                //     'label' => 'نیازمند اصلاح',
                //     'type' => 'info',
                //     'icon' => 'refresh',
                //     'isActive' => $model->canSetForCorrection(),
                //     'url' => [
                //         'change-status',
                //         'id' => $model->id,
                //         'newStatus' => Otherreport::STATUS_NEED_CORRECTION
                //     ]
                // ],
                'accept' => [
                    'label' => 'تایید',
                    'type' => 'info',
                    'icon' => 'check',
                    'isActive' => $model->canAcceptOrReject() &&
                    Yii::$app->user->can('superuser'),
                    // 'visibleFor' => ['superuser'],
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Otherreport::STATUS_ACCEPTED
                    ]
                ],
                'reject' => [
                    'label' => 'رد',
                    'type' => 'info',
                    'icon' => 'close',
                    'isActive' => $model->canAcceptOrReject() &&
                    Yii::$app->user->can('superuser'),
                    // 'visibleFor' => ['superuser'],
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Otherreport::STATUS_REJECTED
                    ]
                ],
                'change-lock' => [
                    'isDropDown' => true,
                    'label' => '&nbsp;&nbsp;&nbsp;قفل&nbsp;&nbsp;&nbsp;',
                    'type' => 'danger',
                    'icon' => 'lock',
                    'isActive' =>  (Yii::$app->user->can('superuser') && ($model->canLock() || $model->canUnlock())),
                    'items' => [
                        'lock' => [
                            'label' => 'بستن قفل',
                            'icon' => 'lock',
                            'isActive' =>  $model->canLock() && Yii::$app->user->can('superuser'),
                            'visible' => true,
                            'url' => [
                                'lock',
                                'id' => $model->id
                            ]
                        ],
                        'unlock' => [
                            'label' => 'باز کردن قفل',
                            'icon' => 'unlock',
                            'isActive' =>  $model->canUnlock() && Yii::$app->user->can('superuser'),
                            'visible' => true,
                            'url' => [
                                'unlock',
                                'id' => $model->id
                            ]
                        ]
                    ]
                ],
                'go-to-history' => [
                    'label' => 'روندهای اجرا شده',
                    'type' => 'success',
                    'icon' => 'sort-amount-desc',
                    'url' => ['view-history', 'id' => $model->id],
                    'isActive' => true,
                    'visible' => true,
                    'options' => [
                        'data-pjax' => 0,
                        'target' => '_blank'
                    ]
                ]
            ]
        ]) ?>
        <hr>
        <h3 class="nad-page-title"><?= $this->title ?></h3>

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
                <?php Panel::begin(['title' => 'مشخصات گزارش']) ?>
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
                                [
                                    'attribute' => 'subjectId',
                                    'format' => 'html',
                                    'value' => function($model){
                                        $subject = $model->getSubjectAsString();
                                        if($subject)
                                            return Html::a($subject, ['subject/manage/view', 'id' => $model->subjectId]);
                                        else
                                            return null;
                                    }
                                ],
                                'createdAt:date',
                                [
                                    'label' => 'فایل گزارش',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        if (!$model->hasFile('otherreportDoc')) {
                                            return;
                                        }
                                        return Html::a(
                                            'دانلود مدارک',
                                            $model->getFile('otherreportDoc')->getUrl(),
                                            [
                                                'data-pjax' => '0'
                                            ]
                                        );
                                    }
                                ],
                                [
                                    'label' => 'مدارک',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        if (!$model->getFile('file')) {
                                            return;
                                        }
                                        return Html::a(
                                            'دانلود مدارک',
                                            $model->getFile('file')->getUrl(),
                                            [
                                                'data-pjax' => '0'
                                            ]
                                        );
                                    }
                                ]
                            ]
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                [
                                    'attribute' => 'partners',
                                    'value' => function ($model) {
                                        return $model->getPartnerFullNamesAsString();
                                    }
                                ],
                                'deliverToManagerDate:date',
                                'sessionDate:dateTime',
                                'updatedAt:date',
                                [
                                    'attribute' => 'status',
                                    'value' =>  function ($model) {
                                        return $model->getStatusLabel();
                                    },
                                ],
                                [
                                    'attribute' => 'userHolder',
                                    'value' => function ($model) {
                                        return Otherreport::getUserHolderLables()[$model->userHolder];
                                    },
                                    'visible' => function ($model){
                                        return !($model->userHolder == Otherreport::USER_HOLDER_MANAGER && $model->status == Otherreport::STATUS_IN_MANAGER_HAND);
                                    }
                                ],
                                [
                                    'attribute' => 'tags',
                                    'value' => function ($model) {
                                        return $model->getTagsAsString();
                                    }
                                ],
                                [
                                    'attribute' => 'references',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return $model->getClickableReferencesAsString();
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
                <?php Panel::begin(['title' => 'چکیده']) ?>
                    <div class="well">
                        <?= $model->abstract ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-12">
                <?php Panel::begin(['title' => 'توضیحات']) ?>
                    <div class="well">
                        <?= $model->description ?>
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
            <?php if ($model->negotiationResult) : ?>
                <div class="col-md-12">
                    <?php Panel::begin(['title' => 'نتیجه مذاکره']) ?>
                        <div class="well">
                            <?= $model->negotiationResult ?>
                        </div>
                    <?php Panel::end() ?>
                </div>
            <?php endif; ?>
            <?php if ($model->comments) : ?>
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
