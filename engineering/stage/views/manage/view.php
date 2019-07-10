<?php
use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\widgets\DetailView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;

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
                    'uniqueCode',
                    'title',
                    'category.familyTreeTitle',                    
                    [
                        'attribute' => 'parent.title',
                        'label' => $model->getAttributeLabel('parentId'),
                        'value' => function ($model) {
                            $parent = $model->parent;
                            return ($parent !== null)?$parent->title:null;
                        },
                    ],
                    [
                        'attribute' => 'locations',
                        'value' => function ($model) {
                            $tempLocations=[];
                            foreach ($model->locations as $location) {
                                $tempLocations[]=$location->title;
                            }
                            return empty($tempLocations)?null:implode($tempLocations, ' - ');
                        },
                    ],
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
<?php Panel::end() ?>
</div>
