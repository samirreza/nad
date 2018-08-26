<?php
namespace modules\nad\material\modules\type\assetbundles;

use yii\web\AssetBundle;

class TreeAssetBundle extends AssetBundle
{
    public $sourcePath = '@modules/nad/material/modules/type/assets';

    public $css = ['menu.css'];

    public $js = ['menu.js'];

    public $depends = [
        'core\assets\JqTreeAssetBundle'
    ];
}
