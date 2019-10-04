<?php

use theme\widgets\Panel;
use yii\widgets\DetailView;

?>

<div class="source-category-view">
    <div class="row">
        <div class="col-md-6">
            <?php Panel::begin([
                'title' => 'اطلاعات رده',
                'showCloseButton' => true
            ]) ?>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'uniqueCode',
                        'code',
                        'title',
                        [
                            'label' => 'رده پدر',
                            // 'visible' => !$model->isRoot(),
                            'value' => $model->isRoot() ? 'ندارد' : $model->getParent()->title,
                            'format' => 'raw'
                        ]
                    ]
                ]) ?>
            <?php Panel::end() ?>
        </div>
    </div>
</div>
