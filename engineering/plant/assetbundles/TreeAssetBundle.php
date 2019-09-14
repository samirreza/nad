<?php
namespace nad\engineering\plant\assetbundles;

use yii\web\AssetBundle;

class TreeAssetBundle extends AssetBundle
{
    public $sourcePath = '@nad/engineering/plant/assets';

    public $css = ['tree.css'];

    public $js = ['tree.js'];

    public $depends = [
        'core\assets\JqTreeAssetBundle'
    ];
}
