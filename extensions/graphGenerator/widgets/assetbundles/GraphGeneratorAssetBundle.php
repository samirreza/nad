<?php

namespace nad\extensions\graphGenerator\widgets\assetbundles;

use \yii\web\View;
use yii\web\AssetBundle;

class GraphGeneratorAssetBundle extends AssetBundle
{
    public $sourcePath = '@nad/extensions/graphGenerator/widgets/assets';
    public $jsOptions = ['position' => View::POS_HEAD];

    public $js = [
        'js/d3-version5.js',
        'js/d3-dagre.js',        
    ];

    // public $css = [
    //     'css/graph.css',        
    // ];
}