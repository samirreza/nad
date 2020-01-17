<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use nad\common\helpers\Utility;
use theme\widgets\ActionButtons;
use nad\office\modules\expert\models\Expert;
use nad\common\modules\investigation\otherreport\models\Otherreport;
use nad\extensions\comment\widgets\commentList\CommentList;

?>

<a class="ajaxcreate" data-gridpjaxid="otherreport-view-detailview-pjax"></a>
<div class="otherreport-view">
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
    <?php Pjax::begin(['id' => 'otherreport-view-detailview-pjax']) ?>
        <h3 class="nad-page-title"><?= $this->title ?></h3>
        <div class="row">
            <div class="col-md-12">
                <?php Panel::begin([
                    'title' => 'مشخصات گزارش',
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
                                [
                                    'attribute' => 'subjectId',
                                    'format' => 'html',
                                    'value' => function($model){
                                        $subject = $model->getSubjectAsString();
                                        if($subject)
                                            return Html::a($subject, ['subject/manage/view', 'id' => $model->subjectId]);
                                        else
                                            return null;
                                    }
                                ],
                                'createdAt:date',
                                [
                                    'label' => 'مدارک',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        if (!$model->getFile('otherreportDoc')) {
                                            return;
                                        }
                                        return Html::a(
                                            'دانلود مدارک',
                                            $model->getFile('otherreportDoc')->getUrl(),
                                            [
                                                'data-pjax' => '0'
                                            ]
                                        );
                                    }
                                ],
                                [
                                    'attribute' => 'partners',
                                    'value' => function ($model) {
                                        return $model->getPartnerFullNamesAsString();
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
                                [
                                    'attribute' => 'partners',
                                    'value' => function ($model) {
                                        return $model->getPartnerFullNamesAsString();
                                    }
                                ],
                                'deliverToManagerDate:date',
                                'sessionDate:dateTime',
                                'updatedAt:date',
                                [
                                    'attribute' => 'status',
                                    'value' =>  function ($model) {
                                        return $model->getStatusLabel();
                                    },
                                ],
                                [
                                    'attribute' => 'userHolder',
                                    'value' => function ($model) {
                                        return Otherreport::getUserHolderLables()[$model->userHolder];
                                    },
                                    'visible' => function ($model){
                                        return !($model->userHolder == Otherreport::USER_HOLDER_MANAGER && $model->status == Otherreport::STATUS_IN_MANAGER_HAND);
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
                    'title' => $model->getAttributeLabel('abstract') . ' نسخه نهایی',
                    'showCollapseButton' => true
                    ]) ?>
                    <div class="well">
                        <?= $model->abstract ?>
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
                    <div class="well">
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
                        <div class="well">
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
                        <div class="well">
                            <?= Yii::$app->formatter->asDateTime($model->sessionDate) ?>
                        </div>
                    <?php Panel::end() ?>
                </div>
            <?php endif; ?>
        </div>

    <?php Pjax::end() ?>
</div>

<div class="otherreport-history-view">
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
                <?php if(isset($log['abstract'])): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php Panel::begin([
                                'title' => $model->getAttributeLabel('abstract') . $counterTitle,
                                'showCollapseButton' => true
                                ]) ?>
                                    <?= $log['abstract'] ?>
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