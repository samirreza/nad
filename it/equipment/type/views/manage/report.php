<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use theme\widgets\infoBox\InfoBox;
use nad\it\equipment\type\models\Type;
use nad\it\equipment\type\models\Category;
use nad\it\equipment\type\assetbundles\TreeAssetBundle;

TreeAssetBundle::register($this);

$this->title = 'شناسه تجهیزات';
$this->params['breadcrumbs'] = [
    $this->title
];

?>

<div class="tree-list">
    <div class="sliding-form-wrapper"></div>
    <div class="row">
        <div class="col-md-6">
            <?php Panel::begin([
                'title' => 'درخت تجهیزات آی تی',
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
    <div class="col-md-6">
        <?php Panel::begin(['title' => 'گزارش آماری']) ?>
            <div class="row">
                <div class="col-md-6">
                    <?= InfoBox::widget([
                        'icon' => '',
                        'count' => Category::find()
                            ->andWhere(['depth' => 0])
                            ->count(),
                        'title' => 'تعداد گروه ها'
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= InfoBox::widget([
                        'icon' => '',
                        'count' => Category::find()
                            ->andWhere(['depth' => 1])
                            ->count(),
                        'title' => 'تعداد دسته ها'
                    ]) ?>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-6">
                    <?= InfoBox::widget([
                        'icon' => '',
                        'count' => Category::find()
                            ->andWhere(['depth' => 2])
                            ->count(),
                        'title' => 'تعداد شاخه ها'
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= InfoBox::widget([
                        'icon' => '',
                        'count' => Category::find()
                            ->andWhere(['depth' => 3])
                            ->count(),
                        'title' => 'تعداد زیر شاخه ها'
                    ]) ?>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-6">
                    <?= InfoBox::widget([
                        'icon' => '',
                        'count' => Type::find()->count(),
                        'title' => 'تعداد تجهیزات'
                    ]) ?>
                </div>
            </div>
        <?php Panel::end() ?>
    </div>
</div>

