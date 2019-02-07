<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use nad\office\modules\expert\models\Expert;
use nad\research\investigation\proposal\models\Proposal;
use nad\extensions\comment\widgets\commentList\CommentList;

$this->title = $model->title . ' (' . Proposal::getStatusLables()[$model->status] . ')';
$this->params['breadcrumbs'] = [
    'پژوهش',
    'بررسی',
    ['label' => 'پروپوزال‌ها', 'url' => ['index']],
    $model->title
];

?>

<a class="ajaxcreate" data-gridpjaxid="proposal-view-detailviewpjax"></a>
<div class="proposal-view">
    <?php Pjax::begin(['id' => 'proposal-view-detailviewpjax']) ?>
        <div class="fixed-action-buttons">
            <?= $this->render('@nad/research/investigation/common/views/_base_action_buttons', [
                'model' => $model,
                'modelTitle' => 'پورپوزال',
                'buttons' => [
                    'set-expert' => [
                        'label' => 'تعیین کارشناس',
                        'type' => 'info',
                        'visible' => $model->status == Proposal::STATUS_ACCEPTED,
                        'url' => ['set-expert', 'id' => $model->id],
                        'options' => ['class' => 'ajaxupdate']
                    ],
                    'send-for-project' => [
                        'label' => 'ارسال برای تهیه گزارش',
                        'type' => 'success',
                        'visible' => $model->status == Proposal::STATUS_ACCEPTED &&
                            $model->projectExpertId,
                        'url' => [
                            'change-status',
                            'id' => $model->id,
                            'newStatus' => Proposal::STATUS_READY_FOR_NEXT_STEP
                        ],
                        'options' => ['class' => 'ajaxrequest']
                    ],
                    'create-project' => [
                        'label' => 'درج گزارش',
                        'type' => 'success',
                        'visible' => $model->canUserCreateProject(),
                        'url' => [
                            '/research/investigation/project/manage/create',
                            'proposalId' => $model->id
                        ]
                    ],
                    'project' => [
                        'label' => 'گزارش',
                        'type' => 'primary',
                        'visibleFor' => ['research.expert', 'research.manage'],
                        'visible' => isset($model->project),
                        'url' => [
                            '/research/investigation/project/manage/view',
                            'id' => $model->project->id ?? null
                        ]
                    ]
                ]
            ]) ?>
        </div>
        <div class="sliding-form-wrapper"></div>
        <div id="comment-sliding-form-wrapper"></div>
        <div class="row">
            <div class="col-md-12">
                <?php Panel::begin(['title' => 'مشخصات پروپوزال']) ?>
                    <div class="col-md-6">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'title',
                                'englishTitle',
                                'uniqueCode',
                                'lastCode:farsiNumber',
                                [
                                    'attribute' => 'createdBy',
                                    'value' => function ($model) {
                                        return $model->researcher->fullName;
                                    }
                                ],
                                [
                                    'label' => 'تاریخ تحویل به کارشناس',
                                    'format' => 'date',
                                    'value' => function ($model) {
                                        return $model->source->deliverForProposalDate;
                                    }
                                ],
                                'createdAt:date',
                                [
                                    'attribute' => 'resources',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return $model->getClickableResourcesAsString();
                                    }
                                ],
                                [
                                    'label' => 'مدارک',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        if (!$model->getFile('documents')) {
                                            return;
                                        }
                                        return Html::a(
                                            'دانلود مدارک',
                                            $model->getFile('documents')->getUrl(),
                                            [
                                                'data-pjax' => '0'
                                            ]
                                        );
                                    }
                                ]
                            ]
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                [
                                    'attribute' => 'partners',
                                    'value' => function ($model) {
                                        return $model->getPartnerFullNamesAsString();
                                    }
                                ],
                                [
                                    'attribute' => 'tags',
                                    'value' => function ($model) {
                                        return $model->getTagsAsString();
                                    }
                                ],
                                [
                                    'attribute' => 'sourceId',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return Html::a(
                                            $model->source->title,
                                            [
                                                '/research/source/manage/view',
                                                'id' => $model->sourceId
                                            ],
                                            [
                                                'target' => '_blank',
                                                'data-pjax' => '0'
                                            ]
                                        );
                                    }
                                ],
                                'deliverToManagerDate:date',
                                'sessionDate:dateTime',
                                'negotiateDate:dateTime',
                                [
                                    'attribute' => 'projectExpertId',
                                    'value' => function ($model) {
                                        return Expert::findOne(
                                            $model->projectExpertId
                                        )->fullName ?? null;
                                    }
                                ],
                                'updatedAt:date',
                                [
                                    'attribute' => 'status',
                                    'value' => function ($model) {
                                        return Proposal::getStatusLables()[$model->status];
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
                <?php Panel::begin(['title' => 'ضرورت اجرای طرح']) ?>
                    <div class="well">
                        <?= $model->necessity ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-12">
                <?php Panel::begin(['title' => 'هدف اصلی']) ?>
                    <div class="well">
                        <?= $model->mainPurpose ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-12">
                <?php Panel::begin(['title' => 'هدف فرعی']) ?>
                    <div class="well">
                        <?= $model->secondaryPurpose ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <?php if ($model->proceedings) : ?>
                <div class="col-md-6">
                    <?php Panel::begin(['title' => 'نتیجه برگزاری جلسه']) ?>
                        <div class="well">
                            <?= $model->proceedings ?>
                        </div>
                    <?php Panel::end() ?>
                </div>
            <?php endif; ?>
            <div class="col-md-6">
                <?= CommentList::widget([
                    'model' => $model,
                    'moduleId' => 'proposal',
                    'showCreateButton' => $model->canInsertComment(),
                    'returnUrl' => Url::current()
                ]) ?>
            </div>
        </div>
    <?php Pjax::end() ?>
</div>

<?php $this->registerJs('
    $(".fixed-action-buttons div.col-sm-12 a:first").after($("a.insert-comment"));
    $("a.insert-comment").addClass("btn-top");
') ?>
