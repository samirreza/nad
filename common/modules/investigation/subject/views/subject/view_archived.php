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
                    'title' => 'مشخصات موضوع',
                    'showCollapseButton' => true
                    ]) ?>
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
                                // TODO remove 'reasons' asap
                                //'reasons',
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
                                        return $model->getStatusLabel();
                                    }
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
                    <div class="well">
                        <?= $model->text ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <?php if ($model->proceedings) : ?>
                <div class="col-md-12">
                    <?php Panel::begin([
                        'title' => 'نتیجه جلسه',
                        'showCollapseButton' => true
                        ]) ?>
                        <div class="well">
                            <?= $model->proceedings ?>
                        </div>
                    <?php Panel::end() ?>
                </div>
            <?php endif; ?>
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
