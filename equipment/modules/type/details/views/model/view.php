<?php
use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\widgets\DetailView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;

$this->title = $model->title;
$this->params['breadcrumbs'] = [
    'تجهیزات',
    ['label' => 'انواع', 'url' => ['manage/index']],
    $this->title
];
?>
<div class="page-view">
    <div class="row">
        <div class="col-md-6">
            <?php Panel::begin([
                'title' => 'اطلاعات مدل',
                'showCloseButton' => true
            ]) ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'uniqueCode',
                    'code',
                    'part.uniqueCode',
                    'title',
                ],
            ]) ?>
            <?php Panel::end() ?>
        </div>
    </div>
</div>
