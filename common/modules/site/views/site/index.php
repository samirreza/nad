<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;

$module = $this->context->module;
// $this->title = $module->department.' - '.$module->pluralLabel;
// $this->params['breadcrumbs'] = [
//     $module->department,
//     $module->pluralLabel
// ];
?>

<h4 class="nad-page-title">لیست مکان ها</h4>
<div class="resource-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن مکان و تجهیز',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'site-gridviewpjax',
                    // 'data-params' =>
                    //     'Location[categoryId]=' . $categoryModel->id

                ]
            ],
            'tree' => [
                'label' => 'نمایش درختی',
                'icon' => 'tree',
                'url' => ['tree-list'],
                'type' => 'success',
            ]
        ],
    ]); ?>

    <br>

    <div class="sliding-form-wrapper"></div>

    <?php Panel::begin([
        'title' => Html::encode($this->title)
    ]) ?>
        <?php Pjax::begin([
            'id' => 'site-gridviewpjax',
            'enablePushState' => false,
        ]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'header' => 'شمارنده',
                        'class' => 'yii\grid\SerialColumn'
                    ],
                    'coordinates',
                    [
                        'class' => 'nad\common\grid\Column',
                        'attribute' => 'uniqueCode',
                    ],
                    [
                        // 'class' => 'nad\common\grid\Column',
                        'label' => 'عنوان مرحله',
                        'attribute' => 'stage.familyTreeTitle',
                        'filter' => false
                    ],
                    [
                        'class' => 'nad\common\grid\Column',
                        'attribute' => 'deviceTitle',
                    ],
                    [
                        'class' => 'nad\common\grid\Column',
                        'attribute' => 'deviceCode',
                    ],
                    // 'createdAt:datetime',
                    [
                        'label' => 'فایلها',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a(
                                    '<i class="fa fa-external-link-square fa-2x" style="color:#398439"></i>',
                                    [
                                        '/engineering/piping/site/document/index',
                                    'DocumentSearch[siteId]' => $model->id
                                    ],
                                    [
                                        'title' => 'فایلها',
                                        'data-pjax' => 0
                                    ]
                                );
                        }
                    ],
                    [
                        'header' => 'دسترسی',
                        'class' => 'core\grid\AjaxActionColumn',
                        'template' => '{view} {update} {delete}',
                    ]
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    <?php Panel::end() ?>
</div>
