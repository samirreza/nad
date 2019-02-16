<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use nad\research\investigation\source\models\Source;
use nad\extensions\comment\widgets\commentList\CommentList;

$this->title = $model->title . ' (' . Source::getStatusLables()[$model->status] . ')';
$this->params['breadcrumbs'] = [
    'پژوهش',
    'بررسی',
    ['label' => 'منشاها', 'url' => ['index']],
    $model->title
];

?>

<a class="ajaxcreate" data-gridpjaxid="source-view-detailview-pjax"></a>
<div class="source-view">
    <?php Pjax::begin(['id' => 'source-view-detailview-pjax']) ?>
        <div class="fixed-action-buttons">
            <?= $this->render('@nad/research/investigation/common/views/_base_action_buttons', [
                'model' => $model,
                'modelTitle' => 'منشا',
                'buttons' => [
                    'reject' => [
                        'label' => 'رد',
                        'type' => 'info',
                        'visible' => $model->canAcceptOrRejectOrSendForCorrection(),
                        'url' => [
                            'change-status',
                            'id' => $model->id,
                            'newStatus' => Source::STATUS_REJECTED
                        ],
                        'options' => ['class' => 'ajaxrequest']
                    ],
                    'set-experts' => [
                        'label' => $model->hasAnyExpert() ? 'تغییر کارشناسان' : 'تعیین کارشناسان',
                        'type' => 'info',
                        'visible' => $model->status == Source::STATUS_ACCEPTED,
                        'url' => ['set-experts', 'id' => $model->id],
                        'options' => ['class' => 'ajaxupdate']
                    ],
                    'send-for-proposal' => [
                        'label' => 'ارسال برای نگارش پروپوزال',
                        'type' => 'info',
                        'visible' => $model->status == Source::STATUS_ACCEPTED &&
                            $model->hasAnyExpert(),
                        'url' => [
                            'change-status',
                            'id' => $model->id,
                            'newStatus' => Source::STATUS_READY_FOR_NEXT_STEP
                        ],
                        'options' => ['class' => 'ajaxrequest']
                    ],
                    'create-proposal' => [
                        'label' => 'درج پروپوزال',
                        'type' => 'info',
                        'visibleFor' => ['research.expert', 'research.manage'],
                        'visible' => $model->canUserCreateProposal(),
                        'url' => [
                            '/research/investigation/proposal/manage/create',
                            'sourceId' => $model->id
                        ]
                    ],
                    'proposals' => [
                        'label' => 'پروپوزال‌ها',
                        'type' => 'success',
                        'visibleFor' => ['research.expert', 'research.manage'],
                        'visible' => $model->proposals,
                        'url' => [
                            '/research/investigation/proposal/manage/index',
                            'ProposalSearch[sourceId]' => $model->id
                        ]
                    ]
                ]
            ]) ?>
        </div>
        <div class="sliding-form-wrapper"></div>
        <div id="comment-sliding-form-wrapper"></div>
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
                                        return $model->researcher->fullName;
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
                                    'attribute' => 'resources',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return $model->getClickableResourcesAsString();
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
                                'negotiateDate:dateTime',
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
                        <?= $model->reason ?>
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
            <?php if ($model->proceedings) : ?>
                <div class="col-md-6">
                    <?php Panel::begin([
                        'title' => 'نتیجه ' . $model->getProceedingsLabel(),
                    ]) ?>
                        <div class="well">
                            <?= $model->proceedings ?>
                        </div>
                    <?php Panel::end() ?>
                </div>
            <?php endif; ?>
            <div class="col-md-6">
                <?= CommentList::widget([
                    'model' => $model,
                    'moduleId' => 'source',
                    'showCreateButton' => $model->canInsertComment(),
                    'returnUrl' => Url::current()
                ]) ?>
            </div>
        </div>
    <?php Pjax::end() ?>
</div>

<?php $this->registerJs('
    $(".fixed-action-buttons div.col-sm-12 a:first").before($("a.insert-comment"));
    $("a.insert-comment").addClass("btn-top");
') ?>
