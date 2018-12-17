<?php

namespace nad\research\modules\material\assetbundles;

use yii\web\AssetBundle;

class TreeAssetBundle extends AssetBundle
{
    public $sourcePath = '@nad/research/modules/material/assets';

    public $css = ['tree.css'];

    public $js = ['tree.js'];

    public $depends = ['core\assets\JqTreeAssetBundle'];
}
