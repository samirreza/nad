<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;
use nad\common\widgets\treeView\TreeView;

?>

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
            'instructions' => [
                'label' => 'لیست دستورالعمل',
                'url' => ['manage/index'],
                'type' => 'success',
                'icon' => 'list'
            ]
        ]
    ]) ?>
    <div class="sliding-form-wrapper"></div>
    <div class="row">
        <div class="col-md-7">
            <?php Panel::begin(['title' => 'لیست رده‌ها']) ?>
                <?php Pjax::begin([
                    'id' => 'instruction-category-gridviewpjax',
                    'enablePushState' => false
                ]) ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'class' => 'nad\common\code\CodeGridColumn',
                                'options' => ['style' => 'width:30%']
                            ],
                            'title',
                            [
                                'attribute' => 'depth',
                                'filter' => $searchModel->getDepthList(),
                                'value' => function ($model) {
                                    return $model->getDepthTitle();
                                }
                            ],
                            [
                                'class' => 'core\grid\AjaxActionColumn',
                                'template' => '{view} {update} {delete} {tree}',
                                'options' => ['style' => 'width:20%'],
                                'buttons' => [
                                    'tree' => function ($url, $model, $key) {
                                        return Html::a(
                                            '<span class="fa fa-tree"></span>',
                                            '#',
                                            [
                                                'title' => 'نمایش درخت',
                                                'data-pjax' => 0,
                                                'data-rootid' => $model->id,
                                                'class' => 'reload-tree'
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
        <div class="col-md-5">
            <?= TreeView::widget() ?>
        </div>
    </div>
</div>
