<?php
use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\widgets\DetailView;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;

$this->title = $model->title;
$this->params['breadcrumbs'] = [
    ['label' => 'انبار آی تی', 'url' => ['manage/index']],
    ['label' => 'دسته ها', 'url' => ['index']],
    $this->title
];
?>
<div class="page-view">
    <?= ActionButtons::widget([
        'modelID' => $model->id,
        'buttons' => [
            'update' => ['label' => 'ویرایش'],
            'delete' => ['label' => 'حذف'],
            'create' => ['label' => 'دسته جدید'],
            'index' => ['label' => 'دسته ها']
        ],
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?php Panel::begin([
                'title' => 'اطلاعات دسته',
            ]) ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'title',
                    'createdAt:date',
                    'updatedAt:datetime',
                    'isActive:boolean',
                    [
                        'label' => "دسته پدر",
                        'visible' => !$model->isRoot(),
                        'value' => $model->isRoot() ?: Html::a(
                            $model->getParent()->title,
                            ['view', 'id' => $model->getParent()->id]
                        ),
                        'format' => 'raw'
                    ],
                ],
            ]) ?>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-6">
            <?php Panel::begin([
                'title' => 'زیرمجموعه ها',
            ]) ?>
                <?php if ($model->children(1)->count() > 0) : ?>
                    <ul class="children" style="list-style:none; font-size:115%">
                        <?php foreach ($model->children()->all() as $child) : ?>
                            <li><?= $child->nestedTitle ?></li>
                        <?php endforeach ?>
                    </ul>
                <?php else : ?>
                    این دسته زیر مجموعه ای ندارد.
                <?php endif ?>
            <?php Panel::end() ?>
        </div>
    </div>
</div>
