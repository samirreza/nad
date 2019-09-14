function generateReportGraph(nodes, links){
	let g = new dagreD3.graphlib.Graph().setGraph({rankdir: 'RL', edgesep: 10, ranksep: 80});

	// Add nodes to the graph, set labels, and style
	nodes.forEach(function(node) {
	  let nodeOptions = {reportTitle: node};
	  nodeOptions.labelType = "html";
	  nodeOptions.label = '<div style="dispaly:block;text-align:center">' + nodeOptions.reportTitle + "<hr><b>" + "گزارش" + "</b></div>";
	  nodeOptions.rx = nodeOptions.ry = 5;
	  // nodeOptions.width = nodeOptions.height = 100;
	  nodeOptions.shape = "rect";
	  g.setNode(node, nodeOptions);
	});

	links.forEach(function(link){
		g.setEdge(link.src, link.dest, {label : ""});
	});

	// Create the renderer
	let render = new dagreD3.render();

	// Set up an SVG group so that we can translate the final graph.
	let svg = d3.select("svg"),
	    inner = svg.append("g");
	// Set up zoom support
	let zoom = d3.zoom()
	    .on("zoom", function() {
	      inner.attr("transform", d3.event.transform);
	    });
	// Center the dag
	// let zoomScale = 1;
	// // Get Dagre Graph dimensions
	// let graphWidth = g.graph().width + 80;
	// let graphHeight = g.graph().height + 0;
	// // Get SVG dimensions
	// let width = parseInt(svg.style("width").replace(/px/, ""));
	// let height = parseInt(svg.style("height").replace(/px/, ""));
	// // Calculate applicable scale for zoom
	// zoomScale = Math.max( Math.min(width / graphWidth, height / graphHeight), 0.5);

	// let translate = [(width/2) - ((graphWidth*zoomScale)/2), 0];
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
	let initialScale = 1;
	svg.call(zoom.transform, d3.zoomIdentity.translate((svg.attr("width") - g.graph().width * initialScale) / 2, 20).scale(initialScale));

	// svg.attr('height', g.graph().height * initialScale + 40);
}
