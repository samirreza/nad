<?php
use nad\extensions\graphGenerator\widgets\assetbundles\GraphGeneratorAssetBundle;

GraphGeneratorAssetBundle::register($this);

// if (class_exists('yii\debug\Module')) {
//     $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
// }
?>


<h1>Graph Report Demo</h1>

<svg width="1900" height="1900">
</svg>

<script type="text/javascript">
  var nodes = {};
  for(i=1; i<76; i++){
    nodes[i]={title:i};
  }

  //console.log(nodes);

var g = new dagreD3.graphlib.Graph().setGraph({rankdir: 'RL', edgesep: 10, ranksep: 80});

// Add nodes to the graph, set labels, and style
Object.keys(nodes).forEach(function(node) {
  var value = nodes[node];
  value.label = '<div style="text-align:center">' + node + "<hr><b>" +"0".repeat(Math.random() * 10 + 1) + "</b></div>";
  value.rx = value.ry = 5;
  value.shape = "ellipse";
  value.labelType = "html";
  g.setNode(node, value);
});

function mySetEdge(source, destination){
  g.setEdge(source, destination, {label : ""});
}

// Set up the edges
mySetEdge(1,2);
mySetEdge(1,3);
mySetEdge(1,4);

mySetEdge(2,5);
mySetEdge(2,6);
mySetEdge(2,7);
mySetEdge(2,8);
mySetEdge(2,9);

mySetEdge(3,11);
mySetEdge(3,12);
mySetEdge(3,13);
mySetEdge(3,14);

mySetEdge(4,15);

mySetEdge(5,16);
mySetEdge(16,33);
mySetEdge(33,50);
mySetEdge(6,17);
mySetEdge(7,18);
mySetEdge(18,34);
mySetEdge(8,19);

mySetEdge(19,35);
mySetEdge(35,51);
mySetEdge(35,52);
mySetEdge(35,53);
mySetEdge(35,54);
mySetEdge(51,56);
mySetEdge(52,56);
mySetEdge(53,56);
mySetEdge(54,56);
mySetEdge(51,55);
mySetEdge(52,55);
mySetEdge(53,55);
mySetEdge(54,55);

mySetEdge(19,36);
mySetEdge(36,55);
mySetEdge(36,56);
mySetEdge(8,20);
mySetEdge(20,37);
mySetEdge(20,38);

mySetEdge(56,57);
mySetEdge(57,58);
mySetEdge(58,59);
mySetEdge(58,60);
mySetEdge(58,61);
mySetEdge(58,62);
mySetEdge(59,63);
mySetEdge(60,63);
mySetEdge(61,63);
mySetEdge(62,63);
mySetEdge(9,21);
mySetEdge(21,39);

mySetEdge(21,40);

mySetEdge(10,22);
mySetEdge(22,41);
mySetEdge(41,42);
mySetEdge(42,43);

mySetEdge(11,23);
mySetEdge(11,24);
mySetEdge(11,25);
mySetEdge(12,26);
mySetEdge(13,27);
mySetEdge(13,28);
mySetEdge(27,44);
mySetEdge(27,45);
mySetEdge(28,46);
mySetEdge(46,66);
mySetEdge(66,67);
mySetEdge(28,68);
mySetEdge(28,47);
mySetEdge(28,48);
mySetEdge(14,29);
mySetEdge(14,30);
mySetEdge(14,31);
mySetEdge(14,32);
mySetEdge(29,49);
mySetEdge(30,49);
mySetEdge(31,49);
mySetEdge(29,69);
mySetEdge(30,69);
mySetEdge(31,69);
mySetEdge(69,73);
mySetEdge(49,64);
mySetEdge(64,65);
mySetEdge(69,70);
mySetEdge(70,71);
mySetEdge(71,72);
mySetEdge(15,74);
mySetEdge(74,75);

// Create the renderer
var render = new dagreD3.render();

// Set up an SVG group so that we can translate the final graph.
var svg = d3.select("svg"),
    inner = svg.append("g");
// Set up zoom support
var zoom = d3.zoom()
    .on("zoom", function() {
      inner.attr("transform", d3.event.transform);
    });
// Center the dag
// var zoomScale = 1;
// // Get Dagre Graph dimensions
// var graphWidth = g.graph().width + 80;
// var graphHeight = g.graph().height + 0;
// // Get SVG dimensions
// var width = parseInt(svg.style("width").replace(/px/, ""));
// var height = parseInt(svg.style("height").replace(/px/, ""));
// // Calculate applicable scale for zoom
// zoomScale = Math.max( Math.min(width / graphWidth, height / graphHeight), 0.5);

// var translate = [(width/2) - ((graphWidth*zoomScale)/2), 0];
// zoom.translate(translate);
// zoom.scale(zoomScale);
// zoom.event( inner );

svg.call(zoom);

// g.graph().transition = function(selection) {
//   return selection.transition().duration(500);
// };

// Run the renderer. This is what draws the final graph.
render(inner, g);

////////////////////////////////////////////////////
// inner.selectAll("g.node")
//   .attr("title", function(v) { return styleTooltip(v, g.node(v).description) })
//   .each(function(v) { $(this).tipsy({ gravity: "w", opacity: 1, html: true }); });

// Center the graph
// var initialScale = 0.75;
// svg.call(zoom.transform, d3.zoomIdentity.translate((svg.attr("width") - g.graph().width * initialScale) / 2, 20).scale(initialScale));

svg.attr('height', g.graph().height * initialScale + 40);

</script>