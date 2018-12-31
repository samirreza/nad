<?php

use theme\widgets\ActionButtons;
use nad\research\common\models\BaseResearch;

?>

<?= ActionButtons::widget([
    'visibleFor' => ['research.manage'],
    'buttons' => [
        'deliver-to-manager' => [
            'label' => 'ارسال به مدیر',
            'icon' => 'send',
            'type' => 'info',
            'visible' => $model->canUserDeliverToManager(),
            'visibleFor' => ['research.expert', 'research.manage'],
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
            'visible' => $model->status == BaseResearch::STATUS_WAITING_FOR_MEETING,
            'url' => [
                'change-status',
                'id' => $model->id,
                'newStatus' => BaseResearch::STATUS_MEETING_HELD
            ],
            'options' => ['class' => 'ajaxrequest']
        ],
        'write-proceedings' => [
            'label' => 'ثبت نتیجه برگزاری جلسه',
            'icon' => 'file-word-o',
            'type' => 'info',
            'visible' => $model->status == BaseResearch::STATUS_MEETING_HELD,
            'url' => ['write-proceedings', 'id' => $model->id],
            'options' => ['class' => 'ajaxupdate']
        ],
        'accept' => [
            'label' => 'تایید',
            'icon' => 'check',
            'type' => 'info',
            'visible' => $model->status == BaseResearch::STATUS_MEETING_HELD,
            'url' => [
                'change-status',
                'id' => $model->id,
                'newStatus' => BaseResearch::STATUS_ACCEPTED
            ],
            'options' => ['class' => 'ajaxrequest']
        ],
        'need-correction' => [
            'label' => 'نیازمند اصلاح',
            'icon' => 'refresh',
            'type' => 'info',
            'visible' => $model->status == BaseResearch::STATUS_MEETING_HELD,
            'url' => [
                'change-status',
                'id' => $model->id,
                'newStatus' => BaseResearch::STATUS_NEED_CORRECTION
            ],
            'options' => ['class' => 'ajaxrequest']
        ],
        'reject' => [
            'label' => 'رد',
            'icon' => 'times',
            'type' => 'danger',
            'visible' => $model->status == BaseResearch::STATUS_MEETING_HELD,
            'url' => [
                'change-status',
                'id' => $model->id,
                'newStatus' => BaseResearch::STATUS_REJECTED
            ],
            'options' => ['class' => 'ajaxrequest']
        ],
        'set-experts' => [
            'label' => 'تعیین کارشناسان',
            'icon' => 'graduation-cap',
            'type' => 'info',
            'visible' => $model->status == BaseResearch::STATUS_ACCEPTED,
            'url' => ['set-experts', 'id' => $model->id],
            'options' => ['class' => 'ajaxupdate']
        ],
        'send-for-proposal' => [
            'label' => 'ارسال برای نگارش پروپوزال',
            'icon' => 'clone',
            'type' => 'success',
            'visible' => $model->status == BaseResearch::STATUS_ACCEPTED &&
                $model->hasAnyExpert(),
            'url' => [
                'change-status',
                'id' => $model->id,
                'newStatus' => BaseResearch::STATUS_READY_FOR_NEXT_STEP
            ],
            'options' => ['class' => 'ajaxrequest']
        ],
        'create-proposal' => [
            'label' => 'درج پروپوزال',
            'icon' => 'plus',
            'type' => 'success',
            'visibleFor' => ['research.expert', 'research.manage'],
            'visible' => $model->canUserCreateProposal(),
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
        'update' => [
            'label' => 'ویرایش',
            'visible' => $model->canUserUpdateOrDelete()
        ],
        'delete' => [
            'label' => 'حذف',
            'visible' => $model->canUserUpdateOrDelete()
        ],
        'create' => [
            'label' => 'درج منشا'
        ],
        'index' => [
            'label' => 'منشاها'
        ]
    ]
]) ?>
