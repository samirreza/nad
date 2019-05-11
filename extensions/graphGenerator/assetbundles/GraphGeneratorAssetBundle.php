<?php

namespace theme\assetbundles;

use yii\web\AssetBundle;

class GraphGeneratorAssetBundle extends AssetBundle
{
    public $sourcePath = '@modules/nad/extensions/graphGenerator/assets';

    public $js = [
        'd3/d3.min.js'
    ];
}