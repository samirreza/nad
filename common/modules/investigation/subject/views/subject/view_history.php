<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use nad\common\helpers\Utility;
use theme\widgets\ActionButtons;
use nad\common\modules\investigation\subject\models\Subject;
use nad\extensions\comment\widgets\commentList\CommentList;

?>

<a class="ajaxcreate" data-gridpjaxid="subject-view-detailview-pjax"></a>
<div class="subject-view">
<?= ActionButtons::widget([
    'modelID' => $model->id,
    'buttons' => [
        'go-to-view' => [
            'label' => 'روند در برنامه',
            'type' => 'success',
            'icon' => 'eye',
            'url' => ['view', 'id' => $model->id],
            'isActive' => true,
            'visible' => true,
            'options' => [
                'target' => '_blank'
            ]
        ]
    ]
]);
?>
<hr>
    <?php Pjax::begin(['id' => 'subject-view-detailview-pjax']) ?>
        <h2 class="nad-page-title"><?= $this->title ?></h2>
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
                                // 'sessionDate:dateTime',
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
                    'title' => $model->getAttributeLabel('text') . ' نسخه نهایی',
                    'showCollapseButton' => true
                    ]) ?>
                    <div>
                        <?= $model->text ?>
                    </div>
                <?php Panel::end() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php Panel::begin([
                    'title' => $model->getAttributeLabel('description') . ' نسخه نهایی',
                    'showCollapseButton' => true
                    ]) ?>
                    <div>
                        <?= $model->description ?>
                    </div>
                <?php Panel::end() ?>
            </div>
        </div>
        <div class="row">
            <?php if ($model->proceedings) : ?>
                <div class="col-md-12">
                    <?php Panel::begin([
                        'title' => 'نتیجه جلسه' . ' نسخه نهایی',
                        'showCollapseButton' => true
                        ]) ?>
                        <div>
                            <?= $model->proceedings ?>
                        </div>
                    <?php Panel::end() ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <?php if ($model->sessionDate) : ?>
                <div class="col-md-12">
                    <?php Panel::begin([
                        'title' => 'تاریخ جلسه توجیهی' . ' نسخه نهایی',
                        'showCollapseButton' => true
                        ]) ?>
                        <div>
                            <?= Yii::$app->formatter->asDateTime($model->sessionDate) ?>
                        </div>
                    <?php Panel::end() ?>
                </div>
            <?php endif; ?>
        </div>

    <?php Pjax::end() ?>
</div>

<div class="subject-history-view">
    <div class="row">
        <div class="col-md-12">
            <?php
            foreach ($logs as $logUpdatedAt => $log) :
                $counterTitle = ' ' . 'نسخه ' . Utility::convertNumberToPersianWords($logCounter);
            ?>
                <?php
                // inject comments into history
                $filteredComments = array_filter($allComments, function($comment) use ($logUpdatedAt){
                    return $comment->insertedAt >= $logUpdatedAt;
                });
                if(!Utility::IsNullOrEmpty($filteredComments)):
                ?>
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <?= CommentList::widget([
                                'model' => $model,
                                'moduleId' => $moduleId,
                                'comments' => $filteredComments,
                                'showCreateButton' => false,
                                'showEditDeleteButton' => false
                            ]) ?>
                        </div>
                    </div>
                <?php
                endif;
                // removes already displayed comments to avoid duplication
                foreach ($filteredComments as $key => $value) {
                    unset($allComments[$key]);
                }
                ?>

                <hr>
                <span class="label label-primary">
                    <?= 'تاریخ ویرایش: ' . Yii::$app->formatter->asDateTime($logUpdatedAt) ?>
                </span>

                <?php if(isset($log['title'])): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php Panel::begin([
                                'title' => $model->getAttributeLabel('title') . $counterTitle,
                                'showCollapseButton' => true
                                ]) ?>
                                    <?= $log['title'] ?>
                            <?php Panel::end() ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(isset($log['englishTitle'])): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php Panel::begin([
                                'title' => $model->getAttributeLabel('englishTitle') . $counterTitle,
                                'showCollapseButton' => true
                                ]) ?>
                                    <?= $log['englishTitle'] ?>
                            <?php Panel::end() ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(isset($log['text'])): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php Panel::begin([
                                'title' => $model->getAttributeLabel('text') . $counterTitle,
                                'showCollapseButton' => true
                                ]) ?>
                                    <?= $log['text'] ?>
                            <?php Panel::end() ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(isset($log['description'])): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php Panel::begin([
                                'title' => $model->getAttributeLabel('description') . $counterTitle,
                                'showCollapseButton' => true
                                ]) ?>
                                    <?= $log['description'] ?>
                            <?php Panel::end() ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(isset($log['proceedings'])): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php Panel::begin([
                                'title' => $model->getAttributeLabel('proceedings') . $counterTitle,
                                'showCollapseButton' => true
                                ]) ?>
                                    <?= $log['proceedings'] ?>
                            <?php Panel::end() ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(isset($log['sessionDate'])): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php Panel::begin([
                                'title' => $model->getAttributeLabel('sessionDate') . $counterTitle,
                                'showCollapseButton' => true
                                ]) ?>
                                    <?= Yii::$app->formatter->asDateTime($log['sessionDate']) ?>
                            <?php Panel::end() ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(isset($log['referencesAsString'])): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php Panel::begin([
                                'title' => $model->getAttributeLabel('references') . $counterTitle,
                                'showCollapseButton' => true
                                ]) ?>
                                    <?= $log['referencesAsString'] ?>
                            <?php Panel::end() ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php
                $logCounter -= 1;
            endforeach;
            ?>
        </div>
    </div>
    <!-- remaining comments -->
    <?php if(!empty($allComments)): ?>
        <div class="row">
            <div class="col-md-12">
                <?= CommentList::widget([
                    'model' => $model,
                    'moduleId' => $moduleId,
                    'comments' =>  $allComments,
                    'showCreateButton' => false,
                    'showEditDeleteButton' => false
                ]) ?>
            </div>
        </div>
    <?php endif; ?>
</div>