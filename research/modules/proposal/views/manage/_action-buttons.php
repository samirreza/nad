<?php

use theme\widgets\ActionButtons;
use nad\research\common\models\BaseReasearch;
use nad\research\modules\proposal\models\Proposal;

?>

<?= ActionButtons::widget([
    'visibleFor' => ['research.manage'],
    'buttons' => [
        'deliver-to-manager' => [
            'label' => 'ارسال به مدیر',
            'icon' => 'send',
            'type' => 'info',
            'visible' => $model->canUserDeliverToManager(),
            'visibleFor' => ['expert', 'research.manage'],
            'url' => ['deliver-to-manager', 'id' => $model->id],
            'options' => ['class' => 'ajaxrequest']
        ],
        'set-session-date' => [
            'label' => 'تعیین زمان جلسه توجیحی',
            'icon' => 'clock-o',
            'type' => 'info',
            'visible' => $model->canSetSessionDate(),
            'url' => ['set-session-date', 'id' => $model->id],
            'options' => ['class' => 'ajaxupdate']
        ],
        'meeting-held' => [
            'label' => 'جلسه برگزار شد',
            'icon' => 'check',
            'type' => 'info',
            'visible' => $model->status == BaseReasearch::STATUS_WAITING_FOR_MEETING,
            'url' => [
                'change-status',
                'id' => $model->id,
                'newStatus' => BaseReasearch::STATUS_MEETING_HELD
            ],
            'options' => ['class' => 'ajaxrequest']
        ],
        'write-proceedings' => [
            'label' => 'ثبت نتیجه برگزاری جلسه',
            'icon' => 'file-word-o',
            'type' => 'info',
            'visible' => $model->status == BaseReasearch::STATUS_MEETING_HELD,
            'url' => ['write-proceedings', 'id' => $model->id],
            'options' => ['class' => 'ajaxupdate']
        ],
        'accept' => [
            'label' => 'تایید',
            'icon' => 'check',
            'type' => 'info',
            'visible' => $model->status == BaseReasearch::STATUS_MEETING_HELD,
            'url' => [
                'change-status',
                'id' => $model->id,
                'newStatus' => BaseReasearch::STATUS_ACCEPTED
            ],
            'options' => ['class' => 'ajaxrequest']
        ],
        'need-correction' => [
            'label' => 'نیازمند اصلاح',
            'icon' => 'refresh',
            'type' => 'info',
            'visible' => $model->status == BaseReasearch::STATUS_MEETING_HELD,
            'url' => [
                'change-status',
                'id' => $model->id,
                'newStatus' => BaseReasearch::STATUS_NEED_CORRECTION
            ],
            'options' => ['class' => 'ajaxrequest']
        ],
        'set-expert' => [
            'label' => 'تعیین کارشناس',
            'icon' => 'graduation-cap',
            'type' => 'info',
            'visible' => $model->status == Proposal::STATUS_ACCEPTED,
            'url' => ['set-expert', 'id' => $model->id],
            'options' => ['class' => 'ajaxupdate']
        ],
        'send-for-project' => [
            'label' => 'ارسال برای تهیه گزارش',
            'icon' => 'clone',
            'type' => 'success',
            'visible' => $model->status == Proposal::STATUS_ACCEPTED &&
                $model->expertUserId,
            'url' => [
                'change-status',
                'id' => $model->id,
                'newStatus' => Proposal::STATUS_READY_FOR_PROJECT
            ],
            'options' => ['class' => 'ajaxrequest']
        ],
        'create-project' => [
            'label' => 'درج گزارش',
            'icon' => 'plus',
            'type' => 'success',
            'visibleFor' => ['expert', 'research.manage'],
            'visible' => $model->canUserCreateProject(),
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
            'visible' => $model->canUserUpdateOrDelete()
        ],
        'delete' => [
            'label' => 'حذف',
            'visible' => $model->canUserUpdateOrDelete()
        ],
        'index' => ['label' => 'لیست پروپوزال ها']
    ]
]) ?>
