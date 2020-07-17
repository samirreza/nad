<?php
use yii\helpers\Html;
use yii\bootstrap\Alert;
use theme\widgets\Panel;
use yii\grid\GridView;
use yii\widgets\DetailView;
use nad\common\helpers\Lookup;
use theme\widgets\ActionButtons;
use nad\common\modules\excelmanager\models\ExcelFile;

?>


<?= ActionButtons::widget([
            'modelID' => $model->id,
            'buttons' => [
                'update' => [
                    'type' => 'warning',
                ],
                'delete' => [
                    'type' => 'warning'
                ],
                'index' => [
                    'icon' => 'list',
                    'label' => 'لیست فایلها',
                    'type' => 'success',
                ]
            ]
]);
?>

<div class="view">
<?php Panel::begin([
    'title' => 'مشاهده جزئیات فایل',
    // 'showCloseButton' => true
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
                        'attribute' => 'uniqueCode',
                        'value' => function($model){
                            return $model->getUniqueCode();
                        }
                    ],
                    'title',
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

<div class="row">
    <div class="col-md-12">
        <?php Panel::begin([
            'title' => 'ردیفهای فایل اکسل'
        ]) ?>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterUrl' => false,
                'options' =>[
                    'style' => 'overflow-x:auto;'
                ],
                'columns' => array_merge(
                    [[
                        'class' => 'yii\grid\SerialColumn',
                        'options' => [
                            'width' => '20px'
                        ]
                    ]],
                    $columns
                )
            ])
            ?>
        <?php Panel::end() ?>
    </div>
</div>
