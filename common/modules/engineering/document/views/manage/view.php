<?php
use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\widgets\DetailView;
use theme\widgets\Panel;
use nad\common\helpers\Lookup;
use theme\widgets\ActionButtons;
use nad\common\modules\engineering\document\models\Document;

?>
<div class="view">
<?php Panel::begin([
    'title' => 'شناسنامه',
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
                    'title',
                    [
                        'attribute' => 'documentType',
                        'value' => function($model){
                            return Lookup::item(Document::LOOKUP_DOCUMENT_TYPE, $model->documentType);
                        }
                    ],
                    [
                        'attribute' => 'location.category.title',
                        'label' => 'عنوان رده'
                    ],
                    [
                        'attribute' =>'location.category.code',                    
                        'label' => 'شناسه رده'
                    ],
                    [
                        'attribute' =>'location.title',  
                        'label' =>  'گروه مدارک'   
                    ],
                    'revisionNumber',
                    [
                        'attribute' => 'uniqueCode',
                        'value' => function($model){
                            return $model->getUniqueCode();
                        }
                    ],
                    'producerName',
                    'verifierName',
                    // 'location.familyTreeTitle',
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
