<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\bootstrap\Alert;
use yii\widgets\DetailView;
use nad\research\investigation\project\models\Project;
use nad\extensions\comment\widgets\commentList\CommentList;

$this->title = $model->title . ' (' . Project::getStatusLables()[$model->status] . ')';
$this->params['breadcrumbs'] = [
    'پژوهش',
    'بررسی',
    ['label' => 'گزارش‌ها', 'url' => ['index']],
    $model->title
];

$children = $model->children()->all();

?>

<a class="ajaxcreate" data-gridpjaxid="project-view-detailviewpjax"></a>
<div class="project-view">
    <?php Pjax::begin(['id' => 'project-view-detailviewpjax']) ?>
        <div class="fixed-action-buttons">
            <?= $this->render('@nad/research/investigation/common/views/_base_action_buttons', [
                'model' => $model,
                'modelTitle' => 'گزارش',
                'buttons' => [
                    'archive' => [
                        'label' => 'آرشیو کردن',
                        'type' => 'info',
                        'visible' => $model->status == Project::STATUS_ACCEPTED,
                        'url' => [
                            'change-status',
                            'id' => $model->id,
                            'newStatus' => Project::STATUS_FINISHED
                        ],
                        'options' => ['class' => 'ajaxrequest']
                    ]
                ]
            ]) ?>
        </div>
        <p>
            <?php if ($model->canUserUpdateOrDelete() && count($children) > 0): ?>
                <?php Alert::begin(['options' => ['class' => 'alert-warning'], 'closeButton' => false]); ?>
                    <p>
                        <b>احتیاط کنید!</b> با حذف کردن این گزارش تمامی گزارش هایی که زیرمجموعه آن هستند نیز از سیستم حذف می شوند. در حال حاضر این
                        گزارش
                        <strong>* <?= Yii::$app->i18n->translateNumber(count($children)) ?> *</strong>
                        زیر مجموعه دارد.
                    </p>
                <?php Alert::end() ?>
            <?php endif ?>
        </p>
        <div class="sliding-form-wrapper"></div>
        <div id="comment-sliding-form-wrapper"></div>
        <div class="row">
            <div class="col-md-12">
                <?php Panel::begin(['title' => 'مشخصات گزارش']) ?>
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
                                [
                                    'label' => 'تاریخ تحویل به کارشناس',
                                    'format' => 'date',
                                    'value' => function ($model) {
                                        return $model->proposal->deliveryToExpertTime;
                                    }
                                ],
                                'createdAt:date',
                                [
                                    'label' => 'فایل گزارش',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return Html::a(
                                            'دانلود فایل',
                                            $model->getFile('report')->getUrl(),
                                            [
                                                'data-pjax' => '0'
                                            ]
                                        );
                                    }
                                ],
                                [
                                    'attribute' => 'categoryId',
                                    'value' => $model->category->htmlCodedTitle,
                                    'format' => 'raw'
                                ],
                                [
                                    'label' => 'گزارش های پدر',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return $model->getFormattedThingLinks();    
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
                                    'label' => "گزارش پدر",
                                    'visible' => !$model->isRoot(),
                                    'value' => ($model->isRoot()) ?: Html::a(
                                        $model->getParent()->htmlCodedTitle,
                                        ['view', 'id' => $model->getParent()->id]
                                    ),
                                    'format' => 'raw'
                                ],
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
                                        if (!$model->getFile('doc')) {
                                            return;
                                        }
                                        return Html::a(
                                            'دانلود مدارک',
                                            $model->getFile('doc')->getUrl(),
                                            [
                                                'data-pjax' => '0'
                                            ]
                                        );
                                    }
                                ],
                                [
                                    'attribute' => 'tags',
                                    'value' => function ($model) {
                                        return $model->getTagsAsString();
                                    }
                                ],
                                [
                                    'attribute' => 'proposalId',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        return Html::a(
                                            $model->proposal->title,
                                            [
                                                '/research/proposal/manage/view',
                                                'id' => $model->proposalId
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
                                'updatedAt:date',
                                [
                                    'attribute' => 'status',
                                    'value' => function ($model) {
                                        return Project::getStatusLables()[$model->status];
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
                    'title' => 'چکیده'
                ]) ?>
                    <div class="well">
                        <?= $model->abstract ?>
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
                    'moduleId' => 'project',
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
