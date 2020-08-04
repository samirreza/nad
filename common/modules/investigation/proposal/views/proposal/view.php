<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use theme\widgets\ActionButtons;
use nad\office\modules\expert\models\Expert;
use nad\extensions\comment\widgets\commentList\CommentList;
use nad\common\modules\investigation\proposal\models\Proposal;

?>

<a class="ajaxcreate" data-gridpjaxid="proposal-view-detailview-pjax"></a>
<div class="proposal-view">
    <?php Pjax::begin(['id' => 'proposal-view-detailview-pjax']) ?>
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
                    'isActive' => ($model->canUserDeliverToManager() || $model->canManagerDeliverToExpert() || $model->canSendToWriteReport() || Yii::$app->user->can('superuser')),
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
                        'send-for-report' => [
                            'label' => 'جهت نگارش گزارش',
                            'icon' => 'reply',
                            'isActive' => $model->canSendToWriteReport(),
                            'visible' => true,
                            'url' => [
                                'change-status',
                                'id' => $model->id,
                                'newStatus' => $model->getNextStepStatus(Proposal::STATUS_IN_NEXT_STEP)
                            ]
                        ],
                        'send-for-method' => [
                            'label' => 'جهت نگارش روش',
                            'icon' => 'reply',
                            'isActive' => $model->canSendToWriteMethod(),
                            'visible' => true,
                            'url' => [
                                'change-status',
                                'id' => $model->id,
                                'newStatus' => $model->getNextStepStatus(Proposal::STATUS_IN_NEXT_STEP_FOR_METHOD)
                            ]
                        ],
                        'send-for-instruction' => [
                            'label' => 'جهت نگارش دستورالعمل',
                            'icon' => 'reply',
                            'isActive' => $model->canSendToWriteInstruction(),
                            'visible' => true,
                            'url' => [
                                'change-status',
                                'id' => $model->id,
                                'newStatus' => $model->getNextStepStatus(Proposal::STATUS_IN_NEXT_STEP_FOR_INSTRUCTION)
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
                                'newStatus' => Proposal::IS_SOURCE_ARCHIVED_YES
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
                                'newStatus' => Proposal::STATUS_WAITING_FOR_SESSION_DATE
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
                        'newStatus' => Proposal::STATUS_WAIT_FOR_CONVERSATION
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
                //         'newStatus' => Proposal::STATUS_NEED_CORRECTION
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
                        'newStatus' => Proposal::STATUS_ACCEPTED
                    ]
                ],
                // We don't have "reject" in proposal
                // 'reject' => [
                //     'label' => 'رد',
                //     'type' => 'info',
                //     'icon' => 'close',
                //     'isActive' => $model->canAcceptOrRejectOrSendForCorrection() &&
                //     Yii::$app->user->can('superuser'),
                //     // 'visibleFor' => ['superuser'],
                //     'url' => [
                //         'change-status',
                //         'id' => $model->id,
                //         'newStatus' => Proposal::STATUS_REJECTED
                //     ]
                // ],
                'set-expert' => [
                    'label' => $model->reportExpertId != null ? 'تغییر کارشناس' : 'انتخاب کارشناس',
                    'type' => 'info',
                    'icon' => 'graduation-cap',
                    'isActive' => $model->canSetExpert(),
                    // 'visibleFor' => ['superuser'],
                    'url' => ['set-expert', 'id' => $model->id],
                    'options' => ['class' => 'ajaxupdate']
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
        <h2 class="nad-page-title"><?= $this->title ?></h2>

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
                <?php Panel::begin(['title' => 'مشخصات پروپوزال', 'showCollapseButton' => true]) ?>
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
                                    'attribute' => 'sourceId',
                                    'format' => 'raw',
                                    'value' => function($model){
                                        $source = $model->getSourceAsString();
                                        if($source)
                                            return Html::a($source,
                                            ['source/manage/view', 'id' => $model->sourceId],
                                            [
                                                'target' => '_blank',
                                                'data-pjax' => '0',
                                            ]
                                        );
                                        else
                                            return null;
                                    }
                                ],
                                [
                                    'label' => 'دسترسی به مرحله بعد',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return Html::a(
                                            'شناسنامه',
                                            ['certificate', 'id' => $model->id],
                                            [
                                                'target' => '_blank',
                                                'data-pjax' => '0',
                                                'style' => 'margin:5px'
                                            ]);
                                    }
                                ],
                                'createdAt:date',
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
                                ],
                                [
                                    'attribute' => 'partners',
                                    'value' => function ($model) {
                                        return $model->getPartnerFullNamesAsString();
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
                    <div class="col-md-6">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
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
                                        return Proposal::getUserHolderLables()[$model->userHolder];
                                    },
                                    'visible' => function ($model){
                                        return !($model->userHolder == Proposal::USER_HOLDER_MANAGER && $model->status == Proposal::STATUS_IN_MANAGER_HAND);
                                    }
                                ],
                                [
                                    'attribute' => 'reportExpertId',
                                    'value' => function ($model) {
                                        if ($model->reportExpertId) {
                                            return Expert::findOne($model->reportExpertId)
                                                ->user
                                                ->fullName;
                                        }
                                    }
                                ],
                                [
                                    'attribute' => 'tags',
                                    'value' => function ($model) {
                                        return $model->getTagsAsString();
                                    }
                                ],
                                [
                                    'label' => 'فایلها',
                                    'format' => 'html',
                                    'value' => function($model){
                                        return $model->getFilesListAsHtml('file');
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
                <?php Panel::begin(['title' => $model->getAttributeLabel('reasonForGenesis'), 'showCollapseButton' => true]) ?>
                    <div>
                        <?= $model->reasonForGenesis ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-12">
                <?php Panel::begin(['title' => $model->getAttributeLabel('necessity'), 'showCollapseButton' => true]) ?>
                    <div>
                        <?= $model->necessity ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-12">
                <?php Panel::begin(['title' => $model->getAttributeLabel('methodDesc'), 'showCollapseButton' => true]) ?>
                    <div>
                        <?= $model->methodDesc ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-12">
                <?php Panel::begin(['title' => $model->getAttributeLabel('estimatedCost'), 'showCollapseButton' => true]) ?>
                    <div>
                        <?= $model->estimatedCost ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <?php if ($model->proceedings) : ?>
                <div class="col-md-12">
                    <?php Panel::begin(['title' => 'نتیجه جلسه', 'showCollapseButton' => true]) ?>
                        <div>
                            <?= $model->proceedings ?>
                        </div>
                    <?php Panel::end() ?>
                </div>
            <?php endif; ?>
            <?php if ($model->negotiationResult) : ?>
                <div class="col-md-12">
                    <?php Panel::begin(['title' => 'نتیجه مذاکره', 'showCollapseButton' => true]) ?>
                        <div>
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
