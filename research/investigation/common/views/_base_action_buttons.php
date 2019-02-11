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
                'label' => 'زمان جلسه',
                'type' => 'info',
                'visible' => $model->canSetSessionDate(),
                'visibleFor' => ['research.manage'],
                'url' => ['set-session-date', 'id' => $model->id],
                'options' => ['class' => 'ajaxupdate']
            ],
            'negotiate' => [
                'label' => 'مذاکره',
                'type' => 'info',
                'visible' => $model->canNegotiate(),
                'visibleFor' => ['research.manage'],
                'url' => ['negotiate', 'id' => $model->id],
                'options' => ['class' => 'ajaxrequest']
            ],
            'write-proceedings' => [
                'label' => 'درج نتیجه ' . $model->getProceedingsLabel(),
                'type' => 'info',
                'visible' => $model->status == BaseInvestigationModel::STATUS_WAITING_FOR_MEETING ||
                    $model->status == BaseInvestigationModel::STATUS_NEGOTIATE_MADE,
                'visibleFor' => ['research.manage'],
                'url' => ['write-proceedings', 'id' => $model->id],
                'options' => ['class' => 'ajaxupdate']
            ],
            'accept' => [
                'label' => 'تایید',
                'type' => 'info',
                'visible' => $model->canAcceptOrRejectOrSendForCorrection(),
                'visibleFor' => ['research.manage'],
                'url' => [
                    'change-status',
                    'id' => $model->id,
                    'newStatus' => BaseInvestigationModel::STATUS_ACCEPTED
                ],
                'options' => ['class' => 'ajaxrequest']
            ],
            'need-correction' => [
                'label' => 'اصلاح',
                'type' => 'info',
                'visible' => $model->canAcceptOrRejectOrSendForCorrection(),
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
            'update' => [
                'label' => 'ویرایش',
                'type' => 'warning',
                'visible' => $model->canUserUpdateOrDelete()
            ],
            'delete' => [
                'label' => 'حذف',
                'type' => 'warning',
                'visible' => $model->canUserUpdateOrDelete()
            ],
            'certificate' => [
                'label' => 'شناسنامه',
                'type' => 'success',
                'visibleFor' => ['research.manage'],
                'url' => [
                    'certificate',
                    'id' => $model->id
                ]
            ]
        ]
    )
]) ?>
