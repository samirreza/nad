<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;
use nad\rla\assetBundles\RlaAssetBundle;

$this->title = 'پیش نمایش داده گاه ها';
$this->params['breadcrumbs'] = [
    $this->title
];

RlaAssetBundle::register($this);
?>

<h3 class="nad-page-title"><?= $this->title ?></h3>

<?= $this->render('@nad/rla/views/manage/_search',
[
    'allowedItemTypes' => $allowedItemTypes,
    'route' => 'preview'
]) ?>

<?php if(isset($dataProvider)): ?>
    <hr>

    <div class="rla-index">
        <div class="sliding-form-wrapper"></div>
        <?php Panel::begin([
            'title' => Html::encode('لیست رکوردهای داده گاه'),
            'showCollapseButton' => true
            ]) ?>
            <?php Pjax::begin([
                        'id' => 'rla-gridviewpjax',
                        'enablePushState' => false,
                    ]); ?>
                <?= GridView::widget([
                    'id' => 'rla-gridview',
                    'dataProvider' => $dataProvider,
                    'filterModel' => $instanceModel,
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn'
                        ],
                        'uniqueCode',
                        'title',
                        [
                            'attribute' => 'createdAt',
                            'value' => function ($model) {
                                return Yii::$app->formatter->asDate(
                                    $model['createdAt'],
                                    'Y-M-d'
                                );
                            }
                        ],
                        [
                            'attribute' => 'updatedAt',
                            'value' => function ($model) {
                                return Yii::$app->formatter->asDate(
                                    $model['updatedAt'],
                                    'Y-M-d'
                                );
                            }
                        ],
                    ]
                ]) ?>
            <?php Pjax::end(); ?>
        <?php Panel::end() ?>
    </div>

    <div id="access_modal_container">
        <div class="modal fade" id="access_modal" tabindex="-1" role="dialog" aria-labelledby="access_modal_label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header bg-danger">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="access_modal_label">خطا</h4>
            </div>
            <div class="modal-body">
            هیچ رکوردی انتخاب نشده است!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">بستن</button>
            </div>
            </div>
        </div>
        </div>
    </div>
<?php endif; ?>