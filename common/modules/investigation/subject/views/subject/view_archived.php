<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use theme\widgets\ActionButtons;
use nad\office\modules\expert\models\Expert;
use nad\common\modules\investigation\subject\models\Subject;
use nad\extensions\comment\widgets\commentList\CommentList;

?>
<?= ActionButtons::widget([
            'modelID' => $model->id,
            'buttons' => [
                'exit-from-archive' => [
                    'label' => 'بازگشت به برنامه',
                    'icon' => 'reply',
                    'isActive' => Yii::$app->user->can('superuser') ,
                    'visible' => true,
                    'url' => [
                        'change-archive',
                        'id' => $model->id,
                        'newStatus' => Subject::IS_SOURCE_ARCHIVED_NO
                    ]
                ]
            ]
]);
?>
<div class="subject-view">
    <?php Pjax::begin(['id' => 'subject-view-detailview-pjax']) ?>
        <div class="row">
            <div class="col-md-12">
            <?php Panel::begin([
                    'title' => 'مشخصات ' . ($model->isReport()? 'گزارش' : 'موضوع'),
                    'showCollapseButton' => true
                    ]) ?>
                    <div class="col-md-6">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'title',
                                'englishTitle',
                                [
                                    'attribute' => 'uniqueCode',
                                    'contentOptions' => [
                                        'style' => 'direction: ltr; text-align: right'
                                    ]
                                ],
                                [
                                    'attribute' => 'createdBy',
                                    'value' => function ($model) {
                                        return $model->researcherTitle;
                                    }
                                ],
                                [
                                    'attribute' => 'tags',
                                    'value' => function ($model) {
                                        return $model->getTagsAsString();
                                    },
                                    'visible' => $model->isReport()
                                ],
                                [
                                    'attribute' => 'partners',
                                    'value' => function ($model) {
                                        return $model->getPartnerFullNamesAsString();
                                    },
                                    'visible' => $model->isReport()
                                ],
                                [
                                    'attribute' => 'references',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return $model->getClickableReferencesAsString();
                                    },
                                    'visible' => $model->isReport()
                                ],
                                [
                                    'attribute' => 'expertId',
                                    'value' => function ($model) {
                                        if ($model->expertId) {
                                            return Expert::findOne($model->expertId)
                                                ->user
                                                ->fullName;
                                        }
                                    }
                                ],
                                [
                                    'attribute' => 'missionObjective',
                                    'visible' => $model->isReport()
                                ],
                                [
                                    'attribute' => 'workshopInfo',
                                    'visible' => $model->isReport()
                                ],
                                [
                                    'attribute' => 'missionPlace',
                                    'visible' => $model->isReport() && $model->isMissionNeeded == Subject::IS_MISSION_NEEDED_YES
                                ],
                                [
                                    'attribute' => 'missionDate',
                                    'format' => 'date',
                                    'visible' => $model->isReport() && $model->isMissionNeeded == Subject::IS_MISSION_NEEDED_YES
                                ],
                                [
                                    'attribute' => 'reportDeadlineDate',
                                    'format' => 'date',
                                    'visible' => $model->isReport()
                                ],
                                [
                                    'attribute' => 'missionType',
                                    'value' => function($model){
                                        return Lookup::item(SubjectCommon::LOOKUP_MISSION_TYPE, $model->missionType);
                                    },
                                    'visible' => $model->isReport() && $model->isMissionNeeded == Subject::IS_MISSION_NEEDED_YES
                                ],
                            ]
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'deliverToManagerDate:date',
                                'sessionDate:dateTime',
                                'createdAt:date',
                                'updatedAt:date',
                                [
                                    'attribute' => 'status',
                                    'value' => function ($model) {
                                        return $model->getStatusLabel();
                                    }
                                ],
                                [
                                    'attribute' => 'userHolder',
                                    'value' => function ($model) {
                                        return Subject::getUserHolderLables()[$model->userHolder];
                                    },
                                    'visible' => function ($model){
                                        return !($model->userHolder == Subject::USER_HOLDER_MANAGER && $model->status == Subject::STATUS_IN_MANAGER_HAND);
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
                <?php Panel::begin([
                    'title' => 'متن موضوع',
                    'showCollapseButton' => true
                    ]) ?>
                    <div>
                        <?= $model->text ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-12">
                <?php Panel::begin([
                    'title' => 'متن گزارش',
                    'showCollapseButton' => true
                    ]) ?>
                    <div>
                        <?= $model->text2 ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-12">
                <?php Panel::begin([
                    'title' => 'توضیحات',
                    'showCollapseButton' => true
                    ]) ?>
                    <div>
                        <?= $model->description ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <?php if ($model->status != Subject::STATUS_WAIT_FOR_CONVERSATION && $model->comments) : ?>
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
