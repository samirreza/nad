<?php

use yii\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;
use theme\assetbundles\RlaAssetBundle;

$this->title = 'پیش نمایش داده گاه ها';
$this->params['breadcrumbs'] = [
    $this->title
];

RlaAssetBundle::register($this);
?>

<h3 class="nad-page-title"><?= $this->title ?></h3>

<?= $this->render('@nad/rla/views/manage/_preview_search',
[
    'allowedItemTypes' => $allowedItemTypes,
    'route' => 'preview'
]) ?>