<?php
use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\widgets\DetailView;
use theme\widgets\Panel;
use nad\common\helpers\Lookup;
use theme\widgets\ActionButtons;
use nad\common\modules\device\models\DocNameLookup;
use nad\common\modules\device\models\DeviceCategoryDocument;

?>
<div class="view">
<?php Panel::begin([
    'title' => 'شناسنامه',
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
                    [
                        'attribute' => 'format',
                        'value' => function($model){
                            return Lookup::item(DeviceCategoryDocument::LOOKUP_DOCUMENT_FORMAT, $model->format);
                        }
                    ],
                    [
                        'attribute' => 'title',
                        'value' => function($model){
                            return DocNameLookup::item(DocNameLookup::TYPE_DEVICE_CATEGORY,$model->title);
                        }
                    ],
                    [
                        'attribute' => 'uniqueCode',
                        'contentOptions' => [
                            'style' => 'direction: ltr; width:160px'
                        ]
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
