<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use nad\common\widgets\treeView\assetbundles\TreeAssetBundle;

TreeAssetBundle::register($this);

?>

<?php Panel::begin([
    'title' => $this->context->title,
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


<?php $this->registerJs("$('#cats-tree').tree($jsOptions)") ?>
