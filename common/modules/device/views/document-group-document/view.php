<?php
use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\widgets\DetailView;
use theme\widgets\Panel;
use nad\common\helpers\Lookup;
use theme\widgets\ActionButtons;
use nad\common\modules\device\models\DocumentGroup;
use nad\common\modules\device\models\DocumentGroupDocument;

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
                    'title',
                    [
                        'attribute' => 'documentType',
                        'value' => function($model){
                            return Lookup::item(DocumentGroupDocument::LOOKUP_DOCUMENT_TYPE, $model->documentType);
                        }
                    ],
                    [
                        'attribute' => 'documentGroup.device.title',
                        'label' => 'عنوان تجهیز'
                    ],
                    [
                        'attribute' =>'documentGroup.device.code',
                        'label' => 'شناسه تجهیز'
                    ],
                    [
                        'attribute' =>'documentGroup.title',
                        'label' =>  'گروه مدارک',
                        'value' => function($model){
                            return Lookup::item(DocumentGroup::LOOKUP_TYPE, $model->documentGroup->title);
                        }
                    ],
                    [
                        'attribute' => 'uniqueCode',
                        'value' => function($model){
                            return $model->getUniqueCode();
                        }
                    ],
                    'producerName',
                    'verifierName',
                    // 'documentGroup.familyTreeTitle',
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
