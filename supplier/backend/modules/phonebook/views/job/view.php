<?php

use themes\admin360\widgets\Panel;
use yii\widgets\DetailView;
use themes\admin360\widgets\ActionButtons;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'لیست تامین کنندگان', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'لیست سمت ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="job-view">
    <div class="row">
        <div class="col-md-6">
            <?php Panel::begin([
                'title' => 'اطلاعات سمت',
            ]) ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'title',
                    'createdAt:date',
                ],
            ]) ?>
            <?php Panel::end() ?>
        </div>
    </div>
</div>
