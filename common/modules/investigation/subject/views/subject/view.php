<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use nad\common\helpers\Lookup;
use nad\common\helpers\Utility;
use theme\widgets\ActionButtons;
use nad\office\modules\expert\models\Expert;
use nad\common\modules\investigation\subject\models\Subject;
use nad\extensions\comment\widgets\commentList\CommentList;
use nad\common\modules\investigation\subject\models\SubjectCommon;

?>

<a class="ajaxcreate" data-gridpjaxid="subject-view-detailview-pjax"></a>
<div class="subject-view">
    <?php Pjax::begin(['id' => 'subject-view-detailview-pjax']) ?>
        <?= ActionButtons::widget([
            'modelID' => $model->id,
            'buttons' => [
                'update' => [
                    'label' => ($model->isReport()?'نگارش گزارش' : 'ویرایش موضوع'),
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
                        'send-for-otherreport' => [
                            'label' => 'جهت نگارش گزارش',
                            'icon' => 'reply',
                            'isActive' => $model->canSendToWriteReport(),
                            'visible' => true,
                            'url' => [
                                'change-status',
                                'id' => $model->id,
                                'newStatus' => Subject::STATUS_WAITING_FOR_EXPERT_ACCEPT
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
                                'newStatus' => Subject::IS_SOURCE_ARCHIVED_YES
                            ],
                            'options' => ['data-pjax' => 0]
                        ],
                    ]
                ],
                'accept' => [
                    'label' => 'تایید ' . ($model->isReport()? 'گزارش' : 'موضوع'),
                    'type' => 'info',
                    'icon' => 'check',
                    'isActive' => $model->canAcceptOrReject() &&
                    Yii::$app->user->can('superuser'),
                    // 'visibleFor' => ['superuser'],
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => ( $model->isReport() ? Subject::STATUS_REPORT_ACCEPTED : Subject::STATUS_ACCEPTED)
                    ]
                ],
                'reject' => [
                    'label' => 'رد موضوع',
                    'type' => 'info',
                    'icon' => 'close',
                    'isActive' => $model->canAcceptOrReject() &&
                    Yii::$app->user->can('superuser'),
                    'visible' => !$model->isReport(),
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => ( $model->isReport() ? Subject::STATUS_REPORT_REJECTED : Subject::STATUS_REJECTED)
                    ]
                ],
                'reject-report-and-set-expert' => [
                    'label' => 'رد گزارش',
                    'type' => 'info',
                    'icon' => 'close',
                    'isActive' => $model->canAcceptOrReject() &&
                    Yii::$app->user->can('superuser'),
                    'visible' => $model->isReport(),
                    'url' => ['set-expert', 'id' => $model->id],
                    'options' => ['class' => 'ajaxupdate']
                ],
                'session' => [
                    'isDropDown' => true,
                    'label' => '&nbsp;&nbsp;&nbsp;جلسه&nbsp;&nbsp;&nbsp;',
                    'type' => 'info',
                    'icon' => 'users',
                    'isActive' => ($model->canSetWaitForSession() || $model->canSetSessionDate()),
                    'items' => [
                        'wait-for-session' => [
                            'label' => 'نیازمند جلسه',
                            'icon' => 'bank',
                            'isActive' => $model->canSetWaitForSession(),
                            'visible' => true,
                            'url' => [
                                'change-status',
                                'id' => $model->id,
                                'newStatus' => Subject::STATUS_WAITING_FOR_SESSION_DATE
                            ]
                        ],
                        'set-session-date' => [
                            'label' => (isset($model->sessionDate) ? 'ویرایش' : 'ثبت') . ' زمان جلسه',
                            'icon' => 'clock-o',
                            'isActive' => $model->canSetSessionDate(),
                            'visible' => true,
                            'url' => ['set-session-date', 'id' => $model->id],
                            'options' => ['class' => 'ajaxupdate']
                        ]
                    ]
                ],
                'wait-for-converstation' => [
                    'label' => 'نظر/سوال',
                    'type' => 'info',
                    'icon' => 'comments',
                    'isActive' => $model->canStartConverstation(),
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Subject::STATUS_WAIT_FOR_CONVERSATION
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
                //         'newStatus' => Subject::STATUS_NEED_CORRECTION
                //     ]
                // ],
                'set-experts' => [
                    'isDropDown' => true,
                    'label' => 'تصمیمات گزارش',
                    'type' => 'info',
                    'icon' => 'pencil',
                    'isActive' => $model->canSetExpert(),
                    'items' => [
                        'set-expert-and-mission-details' => [
                            'label' => 'تعیین',
                            'icon' => 'pencil',
                            'isActive' => $model->canSetExpert() && !$model->isReport(),
                            'visible' => true,
                            'url' => ['set-expert', 'id' => $model->id],
                            'options' => ['class' => 'ajaxupdate']
                        ],
                        'change-expert-and-mission-details' => [
                            'label' => 'تصحیح',
                            'icon' => 'pencil',
                            'isActive' => $model->canSetExpert() && $model->isReport(),
                            'visible' => true,
                            'url' => ['set-expert', 'id' => $model->id],
                            'options' => ['class' => 'ajaxupdate']
                        ],
                    ]
                    // 'visibleFor' => ['superuser'],
                ],
                'accept-by-expert' => [
                    'label' => 'دریافت',
                    'type' => 'info',
                    'icon' => 'thumbs-up',
                    'isActive' => $model->canExpertAccept(),
                    // 'visibleFor' => ['superuser'],
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Subject::STATUS_ACCEPTED_BY_EXPERT
                    ]
                ],
                'change-lock' => [
                    'isDropDown' => true,
                    'label' => '&nbsp;&nbsp;&nbsp;قفل&nbsp;&nbsp;&nbsp;',
                    'type' => 'danger',
                    'icon' => 'lock',
                    'isActive' => (Yii::$app->user->can('superuser') && ($model->canLock() || $model->canUnlock())),
                    'items' => [
                        'lock' => [
                            'label' => 'بستن قفل',
                            'icon' => 'lock',
                            'isActive' => $model->canLock() && Yii::$app->user->can('superuser'),
                            'visible' => true,
                            'url' => [
                                'lock',
                                'id' => $model->id
                            ]
                        ],
                        'unlock' => [
                            'label' => 'باز کردن قفل',
                            'icon' => 'unlock',
                            'isActive' => $model->canUnlock() && Yii::$app->user->can('superuser'),
                            'visible' => true,
                            'url' => [
                                'unlock',
                                'id' => $model->id
                            ]
                        ]
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
                <?php Panel::begin([
                    'title' => 'مشخصات ' . ($model->isReport()? 'گزارش' : 'موضوع'),
                    'showCollapseButton' => true
                    ]) ?>
                    <div class="col-md-6">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'title',
                                'englishTitle',
                                [
                                    'attribute' => 'uniqueCode',
                                    'contentOptions' => [
                                        'style' => 'direction: ltr; text-align: right'
                                    ]
                                ],
                                [
                                    'attribute' => 'createdBy',
                                    'value' => function ($model) {
                                        return $model->researcherTitle;
                                    }
                                ],
                                [
                                    'attribute' => 'tags',
                                    'value' => function ($model) {
                                        return $model->getTagsAsString();
                                    },
                                    'visible' => $model->isReport()
                                ],
                                [
                                    'attribute' => 'partners',
                                    'value' => function ($model) {
                                        return $model->getPartnerFullNamesAsString();
                                    },
                                    'visible' => $model->isReport()
                                ],
                                [
                                    'attribute' => 'references',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return $model->getClickableReferencesAsString();
                                    },
                                    'visible' => $model->isReport()
                                ],
                                [
                                    'attribute' => 'expertId',
                                    'value' => function ($model) {
                                        if ($model->expertId) {
                                            return Expert::findOne($model->expertId)
                                                ->user
                                                ->fullName;
                                        }
                                    }
                                ],
                                [
                                    'attribute' => 'missionObjective',
                                    'visible' => $model->isReport()
                                ],
                                [
                                    'attribute' => 'workshopInfo',
                                    'visible' => $model->isReport()
                                ],
                                [
                                    'attribute' => 'missionPlace',
                                    'visible' => $model->isReport() && $model->isMissionNeeded == Subject::IS_MISSION_NEEDED_YES
                                ],
                                [
                                    'attribute' => 'missionDate',
                                    'format' => 'date',
                                    'visible' => $model->isReport() && $model->isMissionNeeded == Subject::IS_MISSION_NEEDED_YES
                                ],
                                [
                                    'attribute' => 'reportDeadlineDate',
                                    'format' => 'date',
                                    'visible' => $model->isReport()
                                ],
                                [
                                    'attribute' => 'missionType',
                                    'value' => function($model){
                                        return Lookup::item(SubjectCommon::LOOKUP_MISSION_TYPE, $model->missionType);
                                    },
                                    'visible' => $model->isReport() && $model->isMissionNeeded == Subject::IS_MISSION_NEEDED_YES
                                ],
                            ]
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'deliverToManagerDate:date',
                                'sessionDate:dateTime',
                                'createdAt:date',
                                'updatedAt:date',
                                [
                                    'attribute' => 'status',
                                    'value' => function ($model) {
                                        return $model->getStatusLabel();
                                    }
                                ],
                                [
                                    'attribute' => 'userHolder',
                                    'value' => function ($model) {
                                        return Subject::getUserHolderLables()[$model->userHolder];
                                    },
                                    'visible' => function ($model){
                                        return !($model->userHolder == Subject::USER_HOLDER_MANAGER && $model->status == Subject::STATUS_IN_MANAGER_HAND);
                                    }
                                ],
                                [
                                    'label' => 'مستندات موضوع',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        if (!$model->getFile('subjectFile')) {
                                            return;
                                        }
                                        return Html::a(
                                            'دانلود مستندات موضوع',
                                            $model->getFile('subjectFile')->getUrl(),
                                            [
                                                'data-pjax' => '0'
                                            ]
                                        );
                                    },
                                    'visible' => !$model->isReport()
                                ],
                                [
                                    'label' => 'فایل گزارش',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        if (!$model->getFile('reportFile')) {
                                            return;
                                        }
                                        return Html::a(
                                            'دانلود فایل گزارش',
                                            $model->getFile('reportFile')->getUrl(),
                                            [
                                                'data-pjax' => '0'
                                            ]
                                        );
                                    },
                                    'visible' => $model->isReport()
                                ],
                                [
                                    'label' => 'مدارک',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        if (!$model->getFile('reportFile2')) {
                                            return;
                                        }
                                        return Html::a(
                                            'دانلود مدارک',
                                            $model->getFile('reportFile2')->getUrl(),
                                            [
                                                'data-pjax' => '0'
                                            ]
                                        );
                                    },
                                    'visible' => $model->isReport()
                                ],
                                [
                                    'label' => 'فایل موضوع',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        if (!$model->getFile('subjectFile')) {
                                            return;
                                        }
                                        return Html::a(
                                            'دانلود فایل موضوع',
                                            $model->getFile('subjectFile')->getUrl(),
                                            [
                                                'data-pjax' => '0'
                                            ]
                                        );
                                    },
                                    'visible' => $model->isReport()
                                ],
                            ]
                        ]) ?>
                    </div>
                <?php Panel::end() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php Panel::begin([
                    'title' => 'متن موضوع',
                    'showCollapseButton' => true
                    ]) ?>
                    <div>
                        <?= $model->text ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-12">
                <?php
                if ($model->isReport()) {
                    Panel::begin([
                    'title' => 'متن گزارش',
                    'showCollapseButton' => true
                    ]);
                ?>
                    <div>
                        <?= $model->text2 ?>
                    </div>
                <?php
                    Panel::end();
                }
                ?>
            </div>
            <div class="col-md-12">
                <?php Panel::begin([
                    'title' => 'توضیحات',
                    'showCollapseButton' => true
                    ]) ?>
                    <div>
                        <?= $model->description ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <?php if ($model->status != Subject::STATUS_WAIT_FOR_CONVERSATION && $model->comments) : ?>
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

<?php if($model->status != Subject::STATUS_REPORT_ACCEPTED && !empty($logs)): ?>
    <?php Panel::begin([
        'title' => 'سوابق',
        'showCollapseButton' => true,
        'collapsed' => true
    ]) ?>
    <div class="subject-history-view">
        <div class="row">
            <div class="col-md-12">
                <?php
                foreach ($logs as $logUpdatedAt => $log) :
                    $counterTitle = ' ' . 'نسخه ' . Utility::convertNumberToPersianWords($logCounter);
                ?>
                    <hr>
                    <span class="label label-primary">
                        <?= 'تاریخ ویرایش: ' . Yii::$app->formatter->asDateTime($logUpdatedAt) ?>
                    </span>

                    <div class="col-md-12">
                    <?php Panel::begin([
                        'title' => 'مشخصات ' . (isset($log['expertId']) ? 'گزارش' : 'موضوع') . $counterTitle,
                        'showCollapseButton' => true
                        ]) ?>
                        <div class="col-md-6">
                            <?= DetailView::widget([
                                'model' => $log,
                                'attributes' => [
                                    'title:text:' . $model->getAttributeLabel('title'),
                                    'englishTitle:text:' . $model->getAttributeLabel('englishTitle'),
                                    [
                                        'label' => $model->getAttributeLabel('uniqueCode'),
                                        'attribute' => 'uniqueCode',
                                        'contentOptions' => [
                                            'style' => 'direction: ltr; text-align: right'
                                        ]
                                    ],
                                    [
                                        'label' => $model->getAttributeLabel('expertId'),
                                        'attribute' => 'expertId',
                                        'value' => function ($model) {
                                            if (isset($model['expertId'])) {
                                                return Expert::findOne($model['expertId'])
                                                    ->user
                                                    ->fullName;
                                            }

                                            return null;
                                        }
                                    ],
                                    [
                                        'label' => $model->getAttributeLabel('missionObjective'),
                                        'attribute' => 'missionObjective',
                                        'visible' => isset($log['expertId'])
                                    ],
                                    [
                                        'label' => $model->getAttributeLabel('workshopInfo'),
                                        'attribute' => 'workshopInfo',
                                        'visible' => isset($log['expertId'])
                                    ],
                                    [
                                        'label' => $model->getAttributeLabel('missionPlace'),
                                        'attribute' => 'missionPlace',
                                        'visible' => isset($log['expertId']) && $log['isMissionNeeded'] == Subject::IS_MISSION_NEEDED_YES
                                    ],
                                    [
                                        'label' => $model->getAttributeLabel('missionDate'),
                                        'attribute' => 'missionDate',
                                        'format' => 'date',
                                        'visible' => isset($log['expertId']) && $log['isMissionNeeded'] == Subject::IS_MISSION_NEEDED_YES
                                    ],
                                    [
                                        'label' => $model->getAttributeLabel('reportDeadlineDate'),
                                        'attribute' => 'reportDeadlineDate',
                                        'format' => 'date',
                                        'visible' => isset($log['expertId'])
                                    ],
                                    [
                                        'label' => $model->getAttributeLabel('missionType'),
                                        'attribute' => 'missionType',
                                        'value' => function($model){
                                            return Lookup::item(SubjectCommon::LOOKUP_MISSION_TYPE, $model['missionType']);
                                        },
                                        'visible' => isset($log['expertId']) && $log['isMissionNeeded'] == Subject::IS_MISSION_NEEDED_YES
                                    ],
                                ]
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= DetailView::widget([
                                'model' => $log,
                                'attributes' => [
                                    'deliverToManagerDate:date:' . $model->getAttributeLabel('deliverToManagerDate'),
                                    'sessionDate:dateTime:' . $model->getAttributeLabel('sessionDate'),
                                    'createdAt:date:' . $model->getAttributeLabel('createdAt'),
                                    'updatedAt:date:' . $model->getAttributeLabel('updatedAt')
                                ]
                            ]) ?>
                        </div>
                    <?php Panel::end() ?>
                </div>
                    <?php if(isset($log['text'])): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <?php Panel::begin([
                                    'title' => $model->getAttributeLabel('text') . $counterTitle,
                                    'showCollapseButton' => true
                                    ]) ?>
                                        <?= $log['text'] ?>
                                <?php Panel::end() ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(isset($log['text2']) && $log['text2'] != '-' && $log['text2'] != '<p>-</p>'): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <?php Panel::begin([
                                    'title' => $model->getAttributeLabel('text2') . $counterTitle,
                                    'showCollapseButton' => true
                                    ]) ?>
                                        <?= $log['text2'] ?>
                                <?php Panel::end() ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(isset($log['description'])): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <?php Panel::begin([
                                    'title' => $model->getAttributeLabel('description') . $counterTitle,
                                    'showCollapseButton' => true
                                    ]) ?>
                                        <?= $log['description'] ?>
                                <?php Panel::end() ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php
                    $logCounter -= 1;
                endforeach;
                ?>
            </div>
        </div>
    </div>
    <?php Panel::end() ?>
<?php endif; ?>
<br>
<br>
<br>