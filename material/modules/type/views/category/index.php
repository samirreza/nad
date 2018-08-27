<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;
use modules\nad\material\modules\type\models\Category;
use modules\nad\material\modules\type\assetbundles\TreeAssetBundle;

TreeAssetBundle::register($this);

$this->title = 'لیست رده ها';
$this->params['breadcrumbs'] = [
    'مواد',
    ['label' => 'انواع مواد', 'url' => ['manage/index']],
    $this->title
];
?>
<div class="categories-index">
<?= ActionButtons::widget([
    'buttons' => [
        'create' => [
            'label' => 'رده جدید',
            'options' => [
                'class' => 'ajaxcreate',
                'data-gridpjaxid' => 'categories-gridviewpjax'
            ]
        ],
        'materials' => [
            'label' => 'انواع مواد',
            'url' => ['manage/index'],
            'type' => 'info',
            'icon' => 'list'
        ],
    ],
]); ?>

<div class="sliding-form-wrapper"></div>
<div class="row">
    <div class="col-md-7">
        <?php Panel::begin([
            'title' => 'لیست رده ها'
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
                    'compositeCode',
                    [
                        'class' => 'core\grid\TitleColumn',
                        'isAjaxGrid' => true
                    ],
                    [
                        'attribute' => 'depth',
                        'filter' => Category::getDepthList(),
                        'value' => function ($model) {
                            return $model->getDepthTitle();
                        }
                    ],
                    [
                        'class' => 'core\grid\AjaxActionColumn',
                        'template' => '{view} {update} {delete} {tree}',
                        'buttons' => [
                            'tree' => function ($url, $model, $key) {
                                if (!$model->isRoot()) {
                                    return;
                                }
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
                        ],
                    ]
                ],
            ]); ?>
        <?php Pjax::end(); ?>
        <?php Panel::end() ?>
    </div>
    <div class="col-md-5">
        <?php Panel::begin([
            'title' => 'نمایش درختی',
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

