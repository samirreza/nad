<?php
use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\widgets\DetailView;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;

$this->title = $model->title;
$this->params['breadcrumbs'][] = 'تجهیزات';
$this->params['breadcrumbs'] = [
    ['label' => 'انواع', 'url' => ['index']],
    $model->title
];
?>
<div class="page-view">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'update' => ['label' => 'ویرایش'],
            'delete' => ['label' => 'حذف'],
            'create' => ['label' => 'نوع تجهیز جدید'],
            'index' => ['label' => 'انواع تجهیزات']
        ],
    ]); ?>
    <div class="row">
        <div class="col-md-7">
            <?php Panel::begin([
                'title' => 'اطلاعات اصلی',
            ]) ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'compositeCode',
                    'category.title',
                    'title',
                    'createdAt:date',
                    'updatedAt:datetime',
                ],
            ]) ?>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-5">
            <?php Panel::begin([
                'title' => 'توضیحات',
            ]) ?>
                <div class="well">
                    <?= $model->description ?>
                </div>
            <?php Panel::end() ?>
        </div>
    </div>
</div>
