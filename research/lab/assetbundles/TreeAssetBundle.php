<?php
namespace nad\research\lab\assetbundles;

use yii\web\AssetBundle;

class TreeAssetBundle extends AssetBundle
{
    public $sourcePath = '@nad/research/lab/assets';

    public $css = ['tree.css'];

    public $js = ['tree.js'];

    public $depends = [
        'core\assets\JqTreeAssetBundle'
    ];
}
