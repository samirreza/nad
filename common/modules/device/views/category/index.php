<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;
use nad\common\widgets\treeView\TreeView;

?>

<h2 class="nad-page-title">رده بندی تجهیزات</h2>
<div class="instruction-category-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن رده',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'instruction-category-gridviewpjax',
                    'id' => 'createCategoryBtn'
                ]
            ],
            'deviceIndex' => [
                'label' => 'لیست تجهیزات',
                'icon' => 'list',
                'url' => ['manage/index'],
                'type' => 'success'
            ]
        ]
    ]) ?>
    <div class="sliding-form-wrapper"></div>
    <div class="row">
        <div class="col-md-12">
            <?php Panel::begin(['title' => 'لیست رده‌ها']) ?>
                <?php Pjax::begin([
                    'id' => 'instruction-category-gridviewpjax',
                    'enablePushState' => false
                ]) ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'options' => ['style' => 'width:10px'],
                            ],
                            [
                                'class' => 'nad\common\code\CodeGridColumn',
                                'options' => ['style' => 'width:70px'],
                            ],
                            [
                                'class' => 'nad\common\grid\Column',
                                'attribute' => 'title',
                            ],
                            [
                                'attribute' => 'depth',
                                'filter' => $searchModel->getDepthList(),
                                'value' => function ($model) {
                                    return $model->getDepthTitle();
                                },
                                'options' => ['style' => 'width:80px'],
                            ],
                            [
                                'label' => 'لیست مدارک',
                                'format' => 'html',
                                'value' => function ($model) {
                                    return Html::a(
                                            '<i class="fa fa-external-link-square fa-2x" style="color:#398439"></i>',
                                            [
                                                'device-category-document/index',
                                            'DeviceCategoryDocumentSearch[categoryId]' => $model->id
                                            ],
                                            [
                                                'title' => 'لیست مدارک',
                                                'data-pjax' => 0
                                            ]
                                        );
                                }
                            ],
                            [
                                'header' => 'دسترسی',
                                'class' => 'core\grid\AjaxActionColumn',
                                'template' => '{view} {update} {delete} {tree}',
                                'options' => ['style' => 'width:90px'],
                                'buttons' => [
                                    'tree' => function ($url, $model, $key) {
                                        return Html::a(
                                            '<span class="fa fa-tree"></span>',
                                            ['tree-list', 'id' => $model->id],
                                            [
                                                // 'target' => '_blank',
                                                'title' => 'نمایش درختی رده های دستورالعمل',
                                                'data-pjax' => 0
                                            ]
                                        );
                                    },
                                ]
                            ]
                        ]
                    ]) ?>
                <?php Pjax::end(); ?>
            <?php Panel::end() ?>
        </div>
    </div>
</div>
