<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;
use nad\common\modules\engineering\location\models\Category;
use nad\common\modules\engineering\location\assetbundles\TreeAssetBundle;

TreeAssetBundle::register($this);

$module = $this->context->module;
// $this->title = $module->department.' - '.$module->pluralLabel.' - لیست رده ها';
// $this->params['breadcrumbs'] = [
//     $module->department,
//     ['label' => $module->pluralLabel, 'url' => ['manage/index']],
//     'لیست رده ها'
// ];
?>
<h4 class="nad-page-title">لیست رده بندی مراحل</h4>
<div class="categories-index">
<?= ActionButtons::widget([
    'buttons' => [
        'create' => [
            'label' => $module->categoryCreateBtnLabel,
            'options' => [
                'class' => 'ajaxcreate',
                'data-gridpjaxid' => 'categories-gridviewpjax'
            ]
        ]
    ],
]); ?>

<div class="sliding-form-wrapper"></div>
<div class="row">
    <div class="col-md-12">
        <?php Panel::begin([
            // 'title' => 'لیست رده ها'
        ]) ?>
        <?php Pjax::begin([
            'id' => 'categories-gridviewpjax',
            'enablePushState' => false,
        ]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'class' => 'nad\common\code\CodeGridColumn',
                        'options' => ['style' => 'width:30%'],
                        'isAjaxGrid' => true
                    ],
                    [
                        'class' => 'core\grid\TitleColumn',
                        'isAjaxGrid' => true
                    ],
                    [
                        'label' => 'رده پدر',
                        'value' =>  function ($model) {
                            return $model->getParentTitle();
                        }
                    ],
                    [
                        'attribute' => 'depth',
                        'filter' => $searchModel->getDepthList(),
                        'value' => function ($model) {
                            return $model->getDepthTitle();
                        }
                    ],    
                    [
                        'label' => 'بسته مدارک',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a(
                                    '<i class="fa fa-external-link-square fa-2x" style="color:#398439"></i>',
                                    [
                                        '/engineering/piping/location/manage/index',
                                    'LocationSearch[categoryId]' => $model->id
                                    ],                                    
                                    [
                                        'title' => 'لیست گروه های مدارک بسته مدارک',
                                        'data-pjax' => 0
                                    ]
                                );
                        }
                    ],                
                    [
                        'header' => 'دسترسی',
                        'class' => 'core\grid\AjaxActionColumn',
                        'template' => '{view} {update} {delete} {tree}',
                        'options' => ['style' => 'width:20%'],
                        'buttons' => [
                            'tree' => function ($url, $model, $key) use ($module) {
                                return Html::a(
                                    '<span class="fa fa-tree"></span>',
                                    '#',
                                    [
                                        'title' => 'نمایش درختی رده های ' . $module->pluralLabel,
                                        'data-pjax' => 0,
                                        'data-rootid' => $model->id,
                                        'class' => 'reload-tree'
                                    ]
                                );
                            },                            
                        ],
                    ],
                    'createdAt:datetime',
                ],
            ]); ?>
        <?php Pjax::end(); ?>
        <?php Panel::end() ?>
    </div>    
</div>
<div class="row">
    <div class="col-md-11">    
        <?php Panel::begin([
            'title' => 'نمایش درختی رده های ' . $module->pluralLabel,
            'tools' => Html::a(
                '<span class="glyphicon glyphicon-refresh"></span>',
                null,
                [
                    'class' => 'refresh-tree',
                    'data-rootid' => 0
                ]
            )
        ]) ?>
            <div id="loading">
                <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                <span class="sr-only">Loading...</span>
            </div>
            <div id="cats-tree"></div>
        <?php Panel::end() ?>
    </div>    
</div>
