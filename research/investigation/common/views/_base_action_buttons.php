<?php

use theme\widgets\ActionButtons;
use nad\research\investigation\common\models\BaseInvestigationModel;

?>

<?= ActionButtons::widget([
    'modelID' => $model->id,
    'buttons' => array_merge(
        [
            'deliver-to-manager' => [
                'label' => 'ارسال به مدیر',
                'type' => 'info',
                'visible' => $model->canUserDeliverToManager(),
                'visibleFor' => ['research.expert', 'research.manage'],
                'url' => ['deliver-to-manager', 'id' => $model->id],
                'options' => ['class' => 'ajaxrequest']
            ],
            'set-session-date' => [
                'label' => 'تعیین زمان جلسه توجیحی',
                'type' => 'info',
                'visible' => $model->canSetSessionDate(),
                'visibleFor' => ['research.manage'],
                'url' => ['set-session-date', 'id' => $model->id],
                'options' => ['class' => 'ajaxupdate']
            ],
            'negotiate' => [
                'label' => 'مذاکره',
                'type' => 'info',
                'visible' => $model->status == BaseInvestigationModel::STATUS_DELIVERED_TO_MANAGER,
                'visibleFor' => ['research.manage'],
                'url' => ['negotiate', 'id' => $model->id],
                'options' => ['class' => 'ajaxrequest']
            ],
            'meeting-held' => [
                'label' => 'جلسه برگزار شد',
                'type' => 'info',
                'visible' => $model->canHoldSession(),
                'visibleFor' => ['research.manage'],
                'url' => [
                    'change-status',
                    'id' => $model->id,
                    'newStatus' => BaseInvestigationModel::STATUS_MEETING_HELD
                ],
                'options' => ['class' => 'ajaxrequest']
            ],
            'write-proceedings' => [
                'label' => 'ثبت نتیجه برگزاری جلسه / مذاکره',
                'type' => 'info',
                'visible' => $model->status == BaseInvestigationModel::STATUS_MEETING_HELD,
                'visibleFor' => ['research.manage'],
                'url' => ['write-proceedings', 'id' => $model->id],
                'options' => ['class' => 'ajaxupdate']
            ],
            'accept' => [
                'label' => 'تایید',
                'type' => 'info',
                'visible' => $model->status == BaseInvestigationModel::STATUS_DELIVERED_TO_MANAGER ||
                    $model->status == BaseInvestigationModel::STATUS_MEETING_HELD,
                'visibleFor' => ['research.manage'],
                'url' => [
                    'change-status',
                    'id' => $model->id,
                    'newStatus' => BaseInvestigationModel::STATUS_ACCEPTED
                ],
                'options' => ['class' => 'ajaxrequest']
            ],
            'need-correction' => [
                'label' => 'نیازمند اصلاح',
                'type' => 'info',
                'visible' => $model->status == BaseInvestigationModel::STATUS_DELIVERED_TO_MANAGER ||
                    $model->status == BaseInvestigationModel::STATUS_MEETING_HELD,
                'visibleFor' => ['research.manage'],
                'url' => [
                    'change-status',
                    'id' => $model->id,
                    'newStatus' => BaseInvestigationModel::STATUS_NEED_CORRECTION
                ],
                'options' => ['class' => 'ajaxrequest']
            ],
        ],
        $buttons,
        [
            'certificate' => [
                'label' => 'شناسنامه',
                'type' => 'primary',
                'visibleFor' => ['research.manage'],
                'url' => [
                    'certificate',
                    'id' => $model->id
                ]
            ],
            'update' => [
                'label' => 'ویرایش',
                'visible' => $model->canUserUpdateOrDelete()
            ],
            'delete' => [
                'label' => 'حذف',
                'visible' => $model->canUserUpdateOrDelete()
            ]
        ]
    )
]) ?>
