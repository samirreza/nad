<?php

namespace nad\rla\assetBundles;

use yii\web\AssetBundle;

class RlaAssetBundle extends AssetBundle
{
    public $sourcePath = '@nad/rla/assetBundles/assets';

    // public $css = [
    // ];

    public $js = [
        'js/rla.js',
    ];

    public $depends = [
        'yii\grid\GridViewAsset',
        'theme\assetbundles\ThemeAssetBundle',
    ];
}
