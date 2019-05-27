<?php

use \yii\web\View;
use nad\extensions\graphGenerator\widgets\assetbundles\GraphGeneratorAssetBundle;

GraphGeneratorAssetBundle::register($this);

$this->registerJs(
    "
    let nodes = ".$nodes.";
    let links = ".$links.";
    generateReportGraph(nodes, links);
    ",
    View::POS_READY,
    'report-graph-generator'
);

// just to get rid of fucking js/css scripts of Yii debug toolbar which confllicts with D3 :|
if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}
?>


<h3><u>گراف گزارشات</u></h3>

<svg id="graph-container" width="3000" height="3000">
</svg>
