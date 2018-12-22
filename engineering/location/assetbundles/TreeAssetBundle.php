<?php
namespace nad\engineering\location\assetbundles;

use yii\web\AssetBundle;

class TreeAssetBundle extends AssetBundle
{
    public $sourcePath = '@nad/engineering/location/assets';

    public $css = ['tree.css'];

    public $js = ['tree.js'];

    public $depends = [
        'core\assets\JqTreeAssetBundle'
    ];
}
