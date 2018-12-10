<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;
use nad\research\lab\models\Category;
use nad\research\lab\assetbundles\TreeAssetBundle;

TreeAssetBundle::register($this);

$this->title = 'نمایش درختی';
$this->params['breadcrumbs'] = [
    'پژوهش',
    'تجهیزات پزشکی',
    ['label' => 'انواع تجهیزات پزشکی', 'url' => ['index']],
    $this->title
];
?>
<div class="tree-list">
<?= ActionButtons::widget([
    'buttons' => [
        'materials' => [
            'label' => 'انواع تجهیزات پزشکی',
            'url' => ['index'],
            'type' => 'info',
            'icon' => 'list'
        ]
    ],
]); ?>

<div class="sliding-form-wrapper"></div>
<div class="row">
    <div class="col-md-6">
        <?php Panel::begin([
            'title' => 'درخت تجهیزات پزشکی',
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

