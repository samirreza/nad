<?php

use theme\widgets\ActionButtons;
use nad\research\common\models\BaseReasearch;

?>

<?= ActionButtons::widget([
    'visibleFor' => $managerPermission,
    'buttons' => [
        'deliver-to-manager' => [
            'label' => 'ارسال به مدیر',
            'icon' => 'send',
            'type' => 'info',
            'visibleFor' => $deliverToManagerPermission,
            'visible' => $model->canDeliverToManager(),
            'url' => ['deliver-to-manager', 'id' => $model->id],
            'options' => [
                'class' => 'ajaxrequest'
            ]
        ],
        'set-session-date' => [
            'label' => 'تعیین زمان جلسه توجیحی',
            'icon' => 'clock-o',
            'type' => 'info',
            'visible' => $model->canSetSessionDate(),
            'url' => ['set-session-date', 'id' => $model->id],
            'options' => [
                'class' => 'ajaxupdate'
            ]
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
            'options' => [
                'class' => 'ajaxrequest'
            ]
        ],
        'write-proceedings' => [
            'label' => 'ثبت صورت جلسه',
            'icon' => 'file-word-o',
            'type' => 'info',
            'visible' => $model->status == BaseReasearch::STATUS_MEETING_HELD,
            'url' => ['write-proceedings', 'id' => $model->id],
            'options' => [
                'class' => 'ajaxupdate'
            ]
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
            'options' => [
                'class' => 'ajaxrequest'
            ]
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
            'options' => [
                'class' => 'ajaxrequest'
            ]
        ]
    ]
]) ?>
