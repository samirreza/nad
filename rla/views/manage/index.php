<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;
use theme\assetbundles\RlaAssetBundle;

$this->title = 'اعطای دسترسی تک رکورد';
$this->params['breadcrumbs'] = [
    $this->title
];

RlaAssetBundle::register($this);
?>

<h3 class="nad-page-title">اعطای دسترسی تک رکورد</h3>

<?= $this->render('@nad/rla/views/manage/_search',
[
    'searchModel' => $searchModel,
    'model' => $instanceModel,
    'itemTypes' => $itemTypes,
    'route' => 'index'
]) ?>

<hr>

<?= ActionButtons::widget([
            'buttons' => [
                'grant-access' => [
                    'label' => 'اعطا/لغو دسترسی...',
                    'type' => 'info',
                    'icon' => 'lock',
                    'options' => [
                        'id' => 'show_modal_btn',
                        'data-url' => Url::to(['get-access-modal']),
                        'data-grid-id' => 'rla-gridview',
                        'data-modal-id' => 'access_modal',
                        'data-modal-container-id' => 'access_modal_container',
                    ],
                    'url' => '#'
                ]
            ]
]) ?>

<div class="rla-index">
    <div class="sliding-form-wrapper"></div>
    <?php Panel::begin([
        'title' => Html::encode('لیست رکوردهای داده گاه'),
        'showCollapseButton' => true
        ]) ?>

            <?= GridView::widget([
                'id' => 'rla-gridview',
                'dataProvider' => $dataProvider,
                'filterModel' => $instanceModel,
                'rowOptions' => function ($model, $key, $index, $grid) {
                    return [
                        'data' => ['key' => $model->seq_access_id],
                    ];
                },
                'columns' => [
                    [
                        'class' => 'yii\grid\CheckboxColumn',
                        'checkboxOptions' => function ($model, $key, $index, $column)
                            {
                                return ['value' => $model->seq_access_id];
                            },
                    ],
                    [
                        'class' => 'yii\grid\SerialColumn'
                    ],
                    [
                        'class' => 'nad\common\code\CodeGridColumn',
                    ],
                    [
                        'class' => 'nad\common\grid\TitleColumn',
                        'useHyperLink' => false,
                    ],
                    [
                        'attribute' => 'createdAt',
                        'value' => function ($model) {
                            return Yii::$app->formatter->asDate(
                                $model->createdAt,
                                'Y-M-d'
                            );
                        }
                    ],
                    [
                        'attribute' => 'updatedAt',
                        'value' => function ($model) {
                            return Yii::$app->formatter->asDate(
                                $model->updatedAt,
                                'Y-M-d'
                            );
                        }
                    ],
                    // [
                    //     'class' => 'core\grid\AjaxActionColumn',
                    //     'template' => '{view} {update} {delete} {download}',
                    //     'buttons' => [
                    //         'download' => function ($url, $model, $key) {
                    //             if (!$model->hasFile('file')) {
                    //                 return;
                    //             }
                    //             return Html::a(
                    //                 '<span class="fa fa-download"></span>',
                    //                 $model->getFile('file')->getUrl(),
                    //                 [
                    //                     'title' => 'دریافت سند',
                    //                     'data-pjax' => 0
                    //                 ]
                    //             );
                    //         }
                    //     ]
                    // ]
                ]
            ]) ?>

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