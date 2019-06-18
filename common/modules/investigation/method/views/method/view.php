<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use theme\widgets\ActionButtons;
use nad\common\modules\investigation\method\models\Method;
use nad\extensions\comment\widgets\commentList\CommentList;

?>

<a class="ajaxcreate" data-gridpjaxid="method-view-detailview-pjax"></a>
<div class="method-view">
    <?php Pjax::begin(['id' => 'method-view-detailview-pjax']) ?>
        <?= ActionButtons::widget([
            'modelID' => $model->id,
            'buttons' => [
                'update' => [
                    'type' => 'warning',
                    'visible' => $model->canUserUpdateOrDelete()
                ],
                'delete' => [
                    'type' => 'warning',
                    'visible' => $model->canUserUpdateOrDelete()
                ],
                'deliver-to-manager' => [
                    'label' => 'ارسال به مدیر',
                    'type' => 'info',
                    'icon' => 'send',
                    'visible' => $model->canUserDeliverToManager(),
                    'url' => ['deliver-to-manager', 'id' => $model->id]
                ],
                'wait-for-session' => [
                    'label' => 'جلسه',
                    'type' => 'info',
                    'icon' => 'bank',
                    'visible' => $model->status == Method::STATUS_IN_MANAGER_HAND,
                    'visibleFor' => ['superuser'],
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Method::STATUS_WAITING_FOR_SESSION
                    ]
                ],
                'wait-for-negotiation' => [
                    'label' => 'مذاکره',
                    'type' => 'info',
                    'icon' => 'handshake-o',
                    'visible' => $model->status == Method::STATUS_IN_MANAGER_HAND,
                    'visibleFor' => ['superuser'],
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Method::STATUS_WAIT_FOR_NEGOTIATION
                    ]
                ],
                'wait-for-converstation' => [
                    'label' => 'تبادل نظر',
                    'type' => 'info',
                    'icon' => 'comments',
                    'visible' => $model->status == Method::STATUS_IN_MANAGER_HAND &&
                        Yii::$app->user->can('superuser'),
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Method::STATUS_WAIT_FOR_CONVERSATION
                    ]
                ],
                'set-session-date' => [
                    'label' => 'تعیین زمان جلسه',
                    'type' => 'info',
                    'icon' => 'clock-o',
                    'visible' => $model->canSetSessionDate(),
                    'visibleFor' => ['superuser'],
                    'url' => ['set-session-date', 'id' => $model->id],
                    'options' => ['class' => 'ajaxupdate']
                ],
                'write-proceedings' => [
                    'label' => 'ثبت نتیجه جلسه',
                    'type' => 'info',
                    'icon' => 'newspaper-o',
                    'visible' => $model->canWriteProceedings(),
                    'visibleFor' => ['superuser'],
                    'url' => ['write-proceedings', 'id' => $model->id],
                    'options' => ['class' => 'ajaxupdate']
                ],
                'write-negotiation-result' => [
                    'label' => 'ثبت نتیجه مذاکره',
                    'type' => 'info',
                    'icon' => 'newspaper-o',
                    'visible' => $model->canWriteNegotiationResult(),
                    'visibleFor' => ['superuser'],
                    'url' => ['write-negotiation-result', 'id' => $model->id],
                    'options' => ['class' => 'ajaxupdate']
                ],
                'accept' => [
                    'label' => 'تایید',
                    'type' => 'info',
                    'icon' => 'check',
                    'visible' => $model->canAcceptOrRejectOrCorrect(),
                    'visibleFor' => ['superuser'],
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Method::STATUS_ACCEPTED
                    ]
                ],
                'need-correction' => [
                    'label' => 'اصلاح',
                    'type' => 'info',
                    'icon' => 'refresh',
                    'visible' => $model->canAcceptOrRejectOrCorrect(),
                    'visibleFor' => ['superuser'],
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Method::STATUS_NEED_CORRECTION
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
                <?php Panel::begin(['title' => 'مشخصات روش']) ?>
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
                                    'label' => 'فایل فایل دستورالعمل',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        if (!$model->hasFile('instruction')) {
                                            return;
                                        }
                                        return Html::a(
                                            'دانلود فایل دستورالعمل',
                                            $model->getFile('instruction')->getUrl(),
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
                                        if (!$model->hasFile('document')) {
                                            return;
                                        }
                                        return Html::a(
                                            'دانلود مدارک',
                                            $model->getFile('document')->getUrl(),
                                            [
                                                'data-pjax' => '0'
                                            ]
                                        );
                                    }
                                ],
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
                                        return Method::getStatusLables()[$model->status];
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
