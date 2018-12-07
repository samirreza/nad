<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use theme\widgets\ActionButtons;
use nad\research\modules\proposal\models\Proposal;
use nad\extensions\comment\widgets\commentList\CommentList;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'لیست پروپوژال ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<a class="ajaxcreate" data-gridpjaxid="proposal-view-detailviewpjax"></a>
<div class="proposal-view">
    <?php Pjax::begin(['id' => 'proposal-view-detailviewpjax']) ?>
        <?= $this->render('@nad/research/common/views/base-action-buttons', [
            'model' => $model,
            'managerPermission' => ['research.manageProposals'],
            'deliverToManagerPermission' => ['expert']
        ]) ?>
        <?= ActionButtons::widget([
            'visibleFor' => ['research.manageProposals'],
            'buttons' => [
                'set-expert' => [
                    'label' => 'تعیین کارشناس',
                    'icon' => 'graduation-cap',
                    'type' => 'info',
                    'visible' => $model->status == Proposal::STATUS_ACCEPTED,
                    'url' => ['set-expert', 'id' => $model->id],
                    'options' => [
                        'class' => 'ajaxupdate'
                    ]
                ],
                'send-for-project' => [
                    'label' => 'ارسال برای تهیه گزارش',
                    'icon' => 'clone',
                    'type' => 'success',
                    'visible' => $model->status == Proposal::STATUS_ACCEPTED &&
                        $model->expertId,
                    'url' => [
                        'change-status',
                        'id' => $model->id,
                        'newStatus' => Proposal::STATUS_READY_FOR_PROJECT
                    ],
                    'options' => [
                        'class' => 'ajaxrequest'
                    ]
                ],
                'create-project' => [
                    'label' => 'درج گزارش',
                    'icon' => 'plus',
                    'type' => 'success',
                    'visibleFor' => ['expert'],
                    'visible' => $model->status == Proposal::STATUS_READY_FOR_PROJECT,
                    'url' => [
                        '/research/project/manage/create',
                        'proposalId' => $model->id
                    ]
                ]
            ]
        ]) ?>
        <?= ActionButtons::widget([
            'modelID' => $model->id,
            'buttons' => [
                'documentation' => [
                    'label' => $model->hasDocumentation() ? 'مراجع' : 'درج مرجع',
                    'icon' => 'file',
                    'type' => 'info',
                    'url' => ['documentation', 'id' => $model->id]
                ],
                'update' => [
                    'label' => 'ویرایش'
                ],
                'delete' => [
                    'label' => 'حذف'
                ],
                'index' => ['label' => 'لیست پروپوزال ها']
            ]
        ]) ?>
        <div class="sliding-form-wrapper"></div>
        <div class="row">
            <div class="col-md-6">
                <?php Panel::begin(['title' => 'مشخصات پروپوزال']) ?>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id:farsiNumber',
                            'title',
                            'researcherName',
                            'presentationDate:date',
                            'deliverToManagerDate:boolean',
                            'sessionDate:dateTime',
                            [
                                'attribute' => 'expertId',
                                'value' => function ($model) {
                                    if (!$model->expertId) {
                                        return;
                                    }
                                    return $model->expert->email;
                                }
                            ],
                            [
                                'attribute' => 'status',
                                'value' => function ($model) {
                                    return Proposal::getStatusLables()[$model->status];
                                }
                            ],
                            [
                                'attribute' => 'materials',
                                'value' => function ($model) {
                                    return $model->getMaterialsAsString();
                                }
                            ],
                            [
                                'attribute' => 'equipments',
                                'value' => function ($model) {
                                    return $model->getEquipmentsAsString();
                                }
                            ],
                            [
                                'attribute' => 'equipmentParts',
                                'value' => function ($model) {
                                    return $model->getEquipmentPartsAsString();
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
                            'createdAt:dateTime',
                            'updatedAt:dateTime'
                        ]
                    ]) ?>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-6">
                <?= CommentList::widget([
                    'model' => $model,
                    'moduleId' => 'proposal',
                    'showCreateButton' => Yii::$app->user->can(
                        'research.manageProposals'
                    ) && $model->status == Proposal::STATUS_MEETING_HELD
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-ms-12">
                <?php Panel::begin([
                    'title' => 'ضرورت اجرای طرح'
                ]) ?>
                    <div class="well">
                        <?= $model->necessity ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-ms-12">
                <?php Panel::begin([
                    'title' => 'هدف اصلی'
                ]) ?>
                    <div class="well">
                        <?= $model->mainPurpose ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-ms-12">
                <?php Panel::begin([
                    'title' => 'هدف فرعی'
                ]) ?>
                    <div class="well">
                        <?= $model->secondaryPurpose ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-ms-12">
                <?php Panel::begin([
                    'title' => 'صورت جلسه'
                ]) ?>
                    <div class="well">
                        <?= $model->proceedings ?>
                    </div>
                <?php Panel::end() ?>
            </div>
        </div>
    <?php Pjax::end() ?>
</div>
