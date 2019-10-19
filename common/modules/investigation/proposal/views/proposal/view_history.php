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
use nad\common\modules\investigation\proposal\models\Proposal;
use nad\extensions\comment\widgets\commentList\CommentList;

?>

<a class="ajaxcreate" data-gridpjaxid="proposal-view-detailview-pjax"></a>
<div class="proposal-view">
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
    <?php Pjax::begin(['id' => 'proposal-view-detailview-pjax']) ?>
        <h2 class="nad-page-title"><?= $this->title ?></h2>
        <div class="row">
            <div class="col-md-12">
                <?php Panel::begin([
                    'title' => 'مشخصات پروپوزال',
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
                                'deliverToManagerDate:date',
                                'sessionDate:dateTime',
                                'updatedAt:date',
                                [
                                    'attribute' => 'status',
                                    'value' => function ($model) {
                                        return Proposal::getStatusLables()[$model->status];
                                    }
                                ],
                                [
                                    'attribute' => 'reportExpertId',
                                    'value' => function ($model) {
                                        if ($model->reportExpertId) {
                                            return Expert::findOne($model->reportExpertId)
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
                    'title' => $model->getAttributeLabel('reasonForGenesis') . ' نسخه نهایی',
                    'showCollapseButton' => true
                    ]) ?>
                    <div class="well">
                        <?= $model->reasonForGenesis ?>
                    </div>
                <?php Panel::end() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php Panel::begin([
                    'title' => $model->getAttributeLabel('necessity') . ' نسخه نهایی',
                    'showCollapseButton' => true
                    ]) ?>
                    <div class="well">
                        <?= $model->necessity ?>
                    </div>
                <?php Panel::end() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php Panel::begin([
                    'title' => $model->getAttributeLabel('methodDesc') . ' نسخه نهایی',
                    'showCollapseButton' => true
                    ]) ?>
                    <div class="well">
                        <?= $model->methodDesc ?>
                    </div>
                <?php Panel::end() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php Panel::begin([
                    'title' => $model->getAttributeLabel('estimatedCost') . ' نسخه نهایی',
                    'showCollapseButton' => true
                    ]) ?>
                    <div class="well">
                        <?= $model->estimatedCost ?>
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

<div class="proposal-history-view">
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
                <?php if(isset($log['reasonForGenesis'])): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php Panel::begin([
                                'title' => $model->getAttributeLabel('reasonForGenesis') . $counterTitle,
                                'showCollapseButton' => true
                                ]) ?>
                                    <?= $log['reasonForGenesis'] ?>
                            <?php Panel::end() ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(isset($log['necessity'])): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php Panel::begin([
                                'title' => $model->getAttributeLabel('necessity') . $counterTitle,
                                'showCollapseButton' => true
                                ]) ?>
                                    <?= $log['necessity'] ?>
                            <?php Panel::end() ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(isset($log['methodDesc'])): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php Panel::begin([
                                'title' => $model->getAttributeLabel('methodDesc') . $counterTitle,
                                'showCollapseButton' => true
                                ]) ?>
                                    <?= $log['methodDesc'] ?>
                            <?php Panel::end() ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!Utility::IsNullOrEmpty($log['estimatedCost'])): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php Panel::begin([
                                'title' => $model->getAttributeLabel('estimatedCost') . $counterTitle,
                                'showCollapseButton' => true
                                ]) ?>
                                    <?= $log['estimatedCost'] ?>
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