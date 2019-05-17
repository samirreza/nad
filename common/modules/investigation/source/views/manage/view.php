<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use theme\widgets\ActionButtons;
use nad\common\modules\investigation\source\models\Source;
use nad\extensions\comment\widgets\commentList\CommentList;

?>

<a class="ajaxcreate" data-gridpjaxid="source-view-detailview-pjax"></a>
<div class="source-view">
    <?php Pjax::begin(['id' => 'source-view-detailview-pjax']) ?>
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
                    'visible' => $model->canUserDeliverToManager(),
                    'url' => ['deliver-to-manager', 'id' => $model->id]
                ],
                'wait-for-session' => [
                    'label' => 'جلسه',
                    'type' => 'info',
                    'visible' => $model->status == Source::STATUS_IN_MANAGER_HAND,
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Source::STATUS_WAITING_FOR_SESSION
                    ]
                ],
                'wait-for-negotiation' => [
                    'label' => 'مذاکره',
                    'type' => 'info',
                    'visible' => $model->status == Source::STATUS_IN_MANAGER_HAND,
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Source::STATUS_WAIT_FOR_NEGOTIATION
                    ]
                ],
                'wait-for-converstation' => [
                    'label' => 'تبادل نظر',
                    'type' => 'info',
                    'visible' => $model->status == Source::STATUS_IN_MANAGER_HAND,
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Source::STATUS_WAIT_FOR_CONVERSATION
                    ]
                ],
                'set-session-date' => [
                    'label' => 'تعیین زمان جلسه',
                    'type' => 'info',
                    'visible' => $model->canSetSessionDate(),
                    'url' => ['set-session-date', 'id' => $model->id],
                    'options' => ['class' => 'ajaxupdate']
                ],
                'write-proceedings' => [
                    'label' => 'ثبت نتیجه جلسه',
                    'type' => 'info',
                    'visible' => $model->canWriteProceedings(),
                    'url' => ['write-proceedings', 'id' => $model->id],
                    'options' => ['class' => 'ajaxupdate']
                ],
                'write-negotiation-result' => [
                    'label' => 'ثبت نتیجه مذاکره',
                    'type' => 'info',
                    'visible' => $model->canWriteNegotiationResult(),
                    'url' => ['write-negotiation-result', 'id' => $model->id],
                    'options' => ['class' => 'ajaxupdate']
                ],
                'accept' => [
                    'label' => 'تایید',
                    'type' => 'info',
                    'visible' => $model->canAcceptOrRejectOrCorrect(),
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Source::STATUS_ACCEPTED
                    ]
                ],
                'reject' => [
                    'label' => 'رد',
                    'type' => 'info',
                    'visible' => $model->canAcceptOrRejectOrCorrect(),
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Source::STATUS_REJECTED
                    ]
                ],
                'need-correction' => [
                    'label' => 'اصلاح',
                    'type' => 'info',
                    'visible' => $model->canAcceptOrRejectOrCorrect(),
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Source::STATUS_NEED_CORRECTION
                    ]
                ],
                'set-experts' => [
                    'label' => $model->hasAnyExpert() ? 'تغییر کارشناسان' : 'تعیین کارشناسان',
                    'type' => 'info',
                    'visible' => $model->status == Source::STATUS_ACCEPTED,
                    'url' => ['set-experts', 'id' => $model->id],
                    'options' => ['class' => 'ajaxupdate']
                ]
            ]
        ]) ?>
        <br>
        <div class="sliding-form-wrapper"></div>
        <?php if ($model->canInsertComment()) : ?>
            <div class="col-md-12">
                <?= CommentList::widget([
                    'model' => $model,
                    'moduleId' => 'pool',
                    'returnUrl' => Url::current()
                ]) ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <?php Panel::begin(['title' => 'مشخصات منشا']) ?>
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
                                    'attribute' => 'mainReasonId',
                                    'value' => function ($model) {
                                        return $model->mainReason->title;
                                    }
                                ],
                                'reasons',
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
                                [
                                    'attribute' => 'experts',
                                    'value' => function ($model) {
                                        return $model->getExpertFullNamesAsString();
                                    }
                                ],
                                'updatedAt:date',
                                [
                                    'attribute' => 'status',
                                    'value' => function ($model) {
                                        return Source::getStatusLables()[$model->status];
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
                <?php Panel::begin(['title' => 'علت پیدایش']) ?>
                    <div class="well">
                        <?= $model->reasonForGenesis ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-12">
                <?php Panel::begin(['title' => 'ضرورت‌های طرح موضوع']) ?>
                    <div class="well">
                        <?= $model->necessity ?>
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
                        'moduleId' => 'pool',
                        'showCreateButton' => false,
                        'showEditDeleteButton' => false
                    ]) ?>
                </div>
            <?php endif; ?>
        </div>
    <?php Pjax::end() ?>
</div>
