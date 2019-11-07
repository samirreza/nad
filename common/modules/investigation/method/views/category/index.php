<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;
use nad\common\widgets\treeView\TreeView;

?>

<h2 class="nad-page-title">رده بندی روشها</h2>
<div class="method-category-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن رده',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'method-category-gridviewpjax',
                    'id' => 'createCategoryBtn'
                ]
            ]
        ]
    ]) ?>
    <div class="sliding-form-wrapper"></div>
    <div class="row">
        <div class="col-md-12">
            <?php Panel::begin(['title' => 'لیست رده‌ها']) ?>
                <?php Pjax::begin([
                    'id' => 'method-category-gridviewpjax',
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
                            'title',
                            [
                                'attribute' => 'depth',
                                'filter' => $searchModel->getDepthList(),
                                'value' => function ($model) {
                                    return $model->getDepthTitle();
                                },
                                'options' => ['style' => 'width:80px'],
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
                                                'title' => 'نمایش درختی رده های روش',
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
