<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use theme\widgets\ActionButtons;
use nad\common\modules\investigation\source\models\Source;
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
                        'newStatus' => Source::IS_SOURCE_ARCHIVED_NO
                    ]
                ]
            ]
]);
?>
<div class="source-view">
    <?php Pjax::begin(['id' => 'source-view-detailview-pjax']) ?>
        <div class="row">
            <div class="col-md-12">
                <?php Panel::begin([
                    'title' => 'مشخصات منشا',
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
                                    'attribute' => 'mainReasonId',
                                    'value' => function ($model) {
                                        return $model->mainReason->title;
                                    }
                                ],
                                // TODO remove 'reasons' asap
                                //'reasons',
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
                                        return $model->getStatusLabel();
                                    }
                                ],
                                [
                                    'attribute' => 'experts',
                                    'value' => function ($model) {
                                        return $model->getExpertFullNamesAsString();
                                    }
                                ],
                                [
                                    'label' => 'دسترسی به مرحله بعد',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return Html::a(
                                            'شناسنامه',
                                            ['archived-certificate', 'id' => $model->id],
                                            [
                                                'target' => '_blank',
                                                'data-pjax' => '0',
                                                'style' => 'margin:5px'
                                            ]);
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
                    'title' => Html::activeLabel($model, 'reasonForGenesis'),
                    'showCollapseButton' => true
                    ]) ?>
                    <div>
                        <?= $model->reasonForGenesis ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-12">
                <?php Panel::begin([
                    'title' => Html::activeLabel($model, 'necessity'),
                    'showCollapseButton' => true
                    ]) ?>
                    <div>
                        <?= $model->necessity ?>
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
            <?php if ($model->status != Source::STATUS_WAIT_FOR_CONVERSATION && $model->comments) : ?>
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
