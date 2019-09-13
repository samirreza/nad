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
<div class="resource-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن مدارک',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'resource-gridviewpjax',
                    'data-params' => 
                        'Document[groupId]=' . Yii::$app->request->queryParams['DocumentSearch']['groupId']
                    
                ]
            ],
            'stageCategoriesIndex' => [
                'label' => 'لیست رده بندی مراحل و بسته مدارک',
                'icon' => 'sitemap',
                'url' => $this->params['stageCategoriesIndex'],
                'type' => 'success'
            ],
            'groupsIndex' => [
                'label' => 'بسته مدارک',
                'icon' => 'book',
                'url' => $this->params['groupsIndex'],
                'type' => 'success'
            ]
        ],
    ]); ?>

    <div class="sliding-form-wrapper"></div>

    <?php Panel::begin([
        'title' => Html::encode($this->title)
    ]) ?>
        <?php Pjax::begin([
            'id' => 'resource-gridviewpjax',
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
                    [
                        'attribute' => 'uniqueCode',
                    ],
                    [
                        'attribute' => 'revisionNumber',            
                        'value' => function($model){
                            return (isset($model->revisionNumber) ? 'Rev.' . $model->revisionNumber : null);
                        }
                    ],                    
                    [
                        'class' => 'core\grid\TitleColumn',
                        'isAjaxGrid' => true
                    ], 
                    [
                        'header' => 'فایلها',
                        'value' => function($model){
                            if (!$model->hasFile('file')) {
                                return null;
                            }
                            return Html::a(
                                '<span class="fa fa-download"></span>',
                                 $model->getFile('file')->getUrl(),
                                [
                                    'title' => 'دریافت فایل',
                                    'data-pjax' => 0
                                ]
                            );
                        }
                    ],             
                    'createdAt:datetime',                       
                    [
                        'class' => 'core\grid\AjaxActionColumn'                        
                    ]
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    <?php Panel::end() ?>
</div>