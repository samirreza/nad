<?php

namespace nad\research\control\material\assetbundles;

use yii\web\AssetBundle;

class TreeAssetBundle extends AssetBundle
{
    public $sourcePath = '@nad/research/investigation/material/assets';

    public $css = ['tree.css'];

    public $js = ['tree.js'];

    public $depends = ['core\assets\JqTreeAssetBundle'];
}
