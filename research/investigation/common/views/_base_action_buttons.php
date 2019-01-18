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
                'visibleFor' => ['research.manage'],
                'url' => ['set-session-date', 'id' => $model->id],
                'options' => ['class' => 'ajaxupdate']
            ],
            'meeting-held' => [
                'label' => 'جلسه برگزار شد',
                'icon' => 'check',
                'type' => 'info',
                'visible' => $model->status == BaseInvestigationModel::STATUS_WAITING_FOR_MEETING,
                'visibleFor' => ['research.manage'],
                'url' => [
                    'change-status',
                    'id' => $model->id,
                    'newStatus' => BaseInvestigationModel::STATUS_MEETING_HELD
                ],
                'options' => ['class' => 'ajaxrequest']
            ],
            'write-proceedings' => [
                'label' => 'ثبت نتیجه برگزاری جلسه',
                'icon' => 'file-word-o',
                'type' => 'info',
                'visible' => $model->status == BaseInvestigationModel::STATUS_MEETING_HELD,
                'visibleFor' => ['research.manage'],
                'url' => ['write-proceedings', 'id' => $model->id],
                'options' => ['class' => 'ajaxupdate']
            ],
            'accept' => [
                'label' => 'تایید',
                'icon' => 'check',
                'type' => 'info',
                'visible' => $model->status == BaseInvestigationModel::STATUS_MEETING_HELD,
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
                'icon' => 'refresh',
                'type' => 'info',
                'visible' => $model->status == BaseInvestigationModel::STATUS_MEETING_HELD,
                'visibleFor' => ['research.manage'],
                'url' => [
                    'change-status',
                    'id' => $model->id,
                    'newStatus' => BaseInvestigationModel::STATUS_NEED_CORRECTION
                ],
                'options' => ['class' => 'ajaxrequest']
            ]
        ],
        $buttons,
        [
            'update' => [
                'label' => 'ویرایش',
                'visible' => $model->canUserUpdateOrDelete()
            ],
            'delete' => [
                'label' => 'حذف',
                'visible' => $model->canUserUpdateOrDelete()
            ],
            'index' => [
                'label' => "$modelTitle ها"
            ]
        ]
    )
]) ?>
