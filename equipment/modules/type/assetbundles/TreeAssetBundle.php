<?php
namespace modules\nad\equipment\modules\type\assetbundles;

use yii\web\AssetBundle;

class TreeAssetBundle extends AssetBundle
{
    public $sourcePath = '@modules/nad/equipment/modules/type/assets';

    public $css = ['menu.css'];

    public $js = ['menu.js'];

    public $depends = [
        'core\assets\JqTreeAssetBundle'
    ];
}
