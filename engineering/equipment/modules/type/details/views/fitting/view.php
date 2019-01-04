<?php

use theme\widgets\Panel;
use yii\widgets\DetailView;

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
                'title' => 'اطلاعات اتصال',
                'showCloseButton' => true
            ]) ?>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'title',
                        'uniqueCode',
                        'code'
                    ]
                ]) ?>
            <?php Panel::end() ?>
        </div>
    </div>
</div>
