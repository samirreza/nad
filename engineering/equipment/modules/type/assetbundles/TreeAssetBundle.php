<?php

namespace nad\engineering\equipment\modules\type\assetbundles;

use yii\web\AssetBundle;

class TreeAssetBundle extends AssetBundle
{
    public $sourcePath = '@nad/engineering/equipment/modules/type/assets';

    public $css = ['tree.css'];

    public $js = ['tree.js'];

    public $depends = [
        'core\assets\JqTreeAssetBundle'
    ];
}
