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
                'title' => 'شناسنامه'
            ]) ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'title',
                    [
                        'attribute' => 'category.familyTreeTitle',
                        'label' => 'شاخه',
                    ],
                    [
                        'attribute' => 'uniqueCode',
                        'contentOptions' => [
                            'style' => 'direction: ltr; width:160px'
                        ]
                    ],
                    [
                        'label' => 'تعداد قطعات',
                        'value' => function($model){
                            return $model->getParts()->count();
                        }
                    ],
                    [
                        'label' => 'تعداد اتصالات',
                        'value' => function($model){
                            return $model->getInstances()->count();
                        }
                    ],
                    [
                        'label' => 'تعداد بسته های مدارک',
                        'value' => function($model){
                            return $model->getDocumentGroups()->count();
                        }
                    ],
                    'createdAt:date',
                    'updatedAt:datetime',
                ],
            ]) ?>
            <?php Panel::end() ?>
        </div>
    </div>
<?php Panel::end() ?>
</div>
