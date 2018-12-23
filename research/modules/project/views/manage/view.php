<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use yii\bootstrap\Alert;
use yii\widgets\DetailView;
use nad\research\modules\project\models\Project;
use nad\extensions\comment\widgets\commentList\CommentList;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'گزارش ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;

$children = $model->children()->all();

?>

<a class="ajaxcreate" data-gridpjaxid="project-view-detailviewpjax"></a>
<div class="project-view">
    <?php Pjax::begin(['id' => 'project-view-detailviewpjax']) ?>
        <h2><?= $model->title . ' (' . Project::getStatusLables()[$model->status] . ')' ?></h2>
        <br>
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
        <?= $this->render('_action-buttons', ['model' => $model]) ?>
        <div class="sliding-form-wrapper"></div>
        <div class="row">
            <div class="col-md-6">
                <?php Panel::begin(['title' => 'مشخصات گزارش']) ?>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'title',
                            'uniqueCode',
                            [
                                'attribute' => 'createdBy',
                                'value' => function ($model) {
                                    return $model->researcher->email;
                                }
                            ],
                            'createdAt:date',
                            [
                                'label' => 'فایل',
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
                            'sessionDate:date',
                            [
                                'attribute' => 'status',
                                'value' => function ($model) {
                                    return Project::getStatusLables()[$model->status];
                                }
                            ]
                        ]
                    ]) ?>
                <?php Panel::end() ?>
            </div>
            <div class="col-md-6">
                <?= CommentList::widget([
                    'model' => $model,
                    'moduleId' => 'project',
                    'showCreateButton' => Yii::$app->user->can(
                        'research.manage'
                    ) && $model->status == Project::STATUS_MEETING_HELD
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-ms-12">
                <?php Panel::begin([
                    'title' => 'چکیده'
                ]) ?>
                    <div class="well">
                        <?= $model->abstract ?>
                    </div>
                <?php Panel::end() ?>
            </div>
            <div class="col-ms-12">
                <?php Panel::begin([
                    'title' => 'نتیجه برگزاری جلسه'
                ]) ?>
                    <div class="well">
                        <?= $model->proceedings ?>
                    </div>
                <?php Panel::end() ?>
            </div>
        </div>
    <?php Pjax::end() ?>
</div>
