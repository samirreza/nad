<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;
use nad\common\widgets\treeView\TreeView;

?>

<h2 class="nad-page-title">لیست نام مدارک</h2>
<div class="lookup-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن نام مدرک',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'lookup-gridviewpjax',
                    'id' => 'createCategoryBtn'
                ]
            ]
        ]
    ]) ?>
    <div class="sliding-form-wrapper"></div>
    <div class="row">
        <div class="col-md-12">
            <?php Panel::begin(['title' => 'لیست نام ها']) ?>
                <?php Pjax::begin([
                    'id' => 'lookup-gridviewpjax',
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
                                'class' => 'nad\common\grid\Column',
                                'attribute' => 'name',
                            ],
                            [
                                'attribute' => 'type',
                                'format' => 'raw',
                                'filter' => $searchModel->getTypes(),
                                'value' => function($model){
                                    $types = $model->getTypes();
                                    return $types[$model->type];
                                }
                            ],
                            [
                                'class' => 'nad\common\grid\Column',
                                'attribute' => 'extra',
                                'label' => 'کد',
                                'options' => ['style' => 'width:120px'],
                            ],
                            [
                                'header' => 'دسترسی',
                                'class' => 'core\grid\AjaxActionColumn',
                                'template' => '{update} {delete}',
                                'options' => ['style' => 'width:90px']
                            ]
                        ]
                    ]) ?>
                <?php Pjax::end(); ?>
            <?php Panel::end() ?>
        </div>
    </div>
</div>
