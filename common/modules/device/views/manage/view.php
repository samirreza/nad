<?php
use yii\helpers\Html;
use yii\bootstrap\Alert;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use nad\common\helpers\Lookup;
use theme\widgets\ActionButtons;
use nad\common\modules\device\models\Device;

?>
<div class="view">
<?php Panel::begin([
    'title' => 'مشاهده جزئیات',
    'showCloseButton' => true
]) ?>
    <div class="row">
        <div class="col-md-7">
            <?php Panel::begin([
                'title' => 'اطلاعات اصلی'
            ]) ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'categoryId',
                        'value' => function($model){
                            return $model->category->title;
                        }
                    ],
                    [
                        'attribute' => 'uniqueCode',
                        'contentOptions' => [
                            'style' => 'direction: ltr; width:160px'
                        ]
                    ],
                    'title',
                    'category.familyTreeTitle',
                    'createdAt:date',
                    'updatedAt:datetime',
                ],
            ]) ?>
            <?php Panel::end() ?>
        </div>
    </div>
<?php Panel::end() ?>
</div>
