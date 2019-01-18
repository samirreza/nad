<?php

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
        <?= $this->render('@nad/research/investigation/common/views/_base_action_buttons', [
            'model' => $model,
            'modelTitle' => 'منشا',
            'buttons' => [
                'reject' => [
                    'label' => 'رد',
                    'icon' => 'times',
                    'type' => 'danger',
                    'visible' => $model->status == Source::STATUS_MEETING_HELD,
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Source::STATUS_REJECTED
                    ],
                    'options' => ['class' => 'ajaxrequest']
                ],
                'set-experts' => [
                    'label' => 'تعیین کارشناسان',
                    'icon' => 'graduation-cap',
                    'type' => 'info',
                    'visible' => $model->status == Source::STATUS_ACCEPTED,
                    'url' => ['set-experts', 'id' => $model->id],
                    'options' => ['class' => 'ajaxupdate']
                ],
                'send-for-proposal' => [
                    'label' => 'ارسال برای نگارش پروپوزال',
                    'icon' => 'clone',
                    'type' => 'success',
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
                    'icon' => 'plus',
                    'type' => 'success',
                    'visibleFor' => ['research.expert', 'research.manage'],
                    'visible' => $model->canUserCreateProposal(),
                    'url' => [
                        '/research/investigation/proposal/manage/create',
                        'sourceId' => $model->id
                    ]
                ]
            ]
        ]) ?>
        <div class="sliding-form-wrapper"></div>
        <div class="row">
            <div class="col-md-6">
                <?php Panel::begin(['title' => 'مشخصات منشا']) ?>
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
                            ],
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
                <?php Panel::end() ?>
            </div>
            <div class="col-md-6">
                <?= CommentList::widget([
                    'model' => $model,
                    'moduleId' => 'source',
                    'showCreateButton' => Yii::$app->user->can('research.manage') &&
                        $model->status == Source::STATUS_MEETING_HELD
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-ms-12">
                <?php Panel::begin(['title' => 'علت پیدایش']) ?>
                    <div class="well">
                        <?= $model->reason ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-ms-12">
                <?php Panel::begin(['title' => 'ضرورت‌های طرح موضوع']) ?>
                    <div class="well">
                        <?= $model->necessity ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-ms-12">
                <?php Panel::begin(['title' => 'نتیجه برگزاری جلسه']) ?>
                    <div class="well">
                        <?= $model->proceedings ?>
                    </div>
                <?php Panel::end() ?>
            </div>
        </div>
    <?php Pjax::end() ?>
</div>
