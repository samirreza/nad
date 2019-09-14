<?php
namespace nad\common\modules\engineering\location\assetbundles;

use yii\web\AssetBundle;

class TreeAssetBundle extends AssetBundle
{
    public $sourcePath = '@nad/common/modules/engineering/location/assets';

    public $css = ['tree.css'];

    public $js = ['tree.js'];

    public $depends = [
        'core\assets\JqTreeAssetBundle'
    ];
}
