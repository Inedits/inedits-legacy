var CoolTree = (function () {

  return {

    init: function() {

      var rootUrl   = "https://"+document.location.hostname;
      var treeLink    = document.getElementById('getTreeLink');
      var labelJSON   = treeLink.href;
      var margin = {top: 0, right: 0, bottom: 0, left: 0},
      width = window.innerWidth - margin.right - margin.left,
      height = window.innerHeight - margin.top - margin.bottom;

      var i = 0,
      duration = 750,
      root;

      var tip = d3.tip()
        .attr('class', 'd3-tip')
        .offset([-10, 0])
        .html(function(d) {
          return d3.select(this).attr('title');
        });

      var drag = d3.behavior.drag()
        .origin(function(d) { return d; })
        .on("dragstart", dragstarted)
        .on("drag", dragged)
        .on("dragend", dragended);

      var zoom = d3.behavior.zoom()
        .scaleExtent([1, 10])
        .on("zoom", zoomed);

      var tree = d3.layout.tree()
          .size([height/1.2, width]);

      var diagonal = d3.svg.diagonal()
          .projection(function(d) { return [d.y, d.x]; });

      var svg = d3.select(".tree-container").append("svg")
          .attr("width", width + margin.right + margin.left)
          .attr("height", height + margin.top + margin.bottom)
          .call(zoom)
        .append("g")
          .attr("transform", "translate(" + margin.left + "," + margin.top + ")")
          .attr("id", "svg")
      ;

      svg.call(tip);

      d3.json(labelJSON, function(error, flare) {
        if (error) throw error;

        root = flare.theTree[0];
        root.x0 = height / 2;
        root.y0 = 0;

        function collapse(d) {
          if (d.children) {
            d._children = d._children;
            d._children.forEach(collapse);
            d._children = null;
          }
        }

        update(root);
      });

      d3.select(self.frameElement).style("height", "800px");

      function update(source) {

        // Compute the new tree layout.
        var nodes = tree.nodes(root).reverse(),
            links = tree.links(nodes);

        // Normalize for fixed-depth.
        nodes.forEach(function(d) { d.y = d.depth * 180; });

        // Update the nodes…
        var node = svg.selectAll("g.node")
            .data(nodes, function(d) { return d.id || (d.id = ++i); });

        // Enter any new nodes at the parent's previous position.
        var nodeEnter = node.enter().append("g")
          .attr("class", function(d){
            return d.parent_id === null ? "node first" : "node";
          })
          .attr("transform", function(d) { return "translate(" + source.y0 + "," + source.x0 + ")"; })
          .on("mouseover", hover)
          .on("mouseout", hoverOut)
        ;

        // First circle
        nodeEnter.append("circle")
          .attr("r", function(d){ if(d.parent_id === null){return 40;} else {return 10;} })
          .attr("slug",  function(d) { return d.slug; } )
          .attr("class",  "child" )
        ;

        // Show Circle
        nodeEnter.append("image")
              .attr("xlink:href", "/img/design/warning.svg")
              .attr("x", -22)
              .attr("y", -70)
              .attr("width", 40)
              .attr("height", 40)
              .attr("slug",  function(d) { return d.slug; } )
              .attr("alt", "Cliquez ici pour voir cette contribution")
              .attr("title", function(d){return "Voir la contribution " + d.title;})
              .attr("class",  function(d) { return "child-links child-links-"+d.slug; } )
              .on("click", clickShow)
              .on("mouseover", tip.show)
              .on("mouseout", tip.hide)
        ;

        // Add child circle
        nodeEnter.append("image")
              .attr("xlink:href", "/img/design/addition.svg")
              .attr("x", 30)
              .attr("y", -20)
              .attr("width", 40 )
              .attr("height", 40)
              .attr("slug",  function(d) { return d.slug; } )
              .attr("class",  function(d) { return "child-links child-links-"+d.slug; } )
              .attr("title", function(d){return "Ajouter une suite à " + d.title;})
              .on("click", clickAddChild)
              .on("mouseover", tip.show)
              .on("mouseout", tip.hide)
        ;

        // Transition nodes to their new position.
        var nodeUpdate = node.transition()
            .duration(duration)
            .attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; });

        nodeUpdate.select("circle")
            .attr("r", 10)
        ;

        nodeUpdate.select("text")
            .style("fill-opacity", 1)
        ;

        // Transition exiting nodes to the parent's new position.
        var nodeExit = node.exit().transition()
            .duration(duration)
            .attr("transform", function(d) { return "translate(" + source.y + "," + source.x + ")"; })
            .remove();

        nodeExit.select("circle")
            .attr("r", function(d){ if(d.parent_id === null){return 20;} else {return 10;} })
        ;

        nodeExit.select("text")
            .style("fill", function(d){return 'url(#'+d.user.slug+')';})
        ;

        // Update the links…
        var link = svg.selectAll("path.link")
            .data(links, function(d) { return d.target.id; });

        // Enter any new links at the parent's previous position.
        link.enter().insert("path", "g")
            .attr("class", "link")
            .attr("d", function(d) {
              var o = {x: source.x0, y: source.y0};
              return diagonal({source: o, target: o});
            });

        // Transition links to their new position.
        link.transition()
            .duration(duration)
            .attr("d", diagonal);

        // Transition exiting nodes to the parent's new position.
        link.exit().transition()
            .duration(duration)
            .attr("d", function(d) {
              var o = {x: source.x, y: source.y};
              return diagonal({source: o, target: o});
            })
            .remove();

        // Stash the old positions for transition.
        nodes.forEach(function(d) {
          d.x0 = d.x;
          d.y0 = d.y;
        });
      }

      // Toggle children on click.
      function updateClick(d) {
        if (d.children) {
          d._children = d.children;
          d.children = null;
        } else {
          d.children = d._children;
          d._children = null;
        }
        update(d);
      }

      function clickAddChild(d) {
        // window.location.href = "https://"+document.location.hostname+"/arbres/"+d.slug+"/ajouter/"+d.id+"/"+d.user_id;
        window.location.href = "http://localhost:8000/arbre/"+d.parent.slug+"/"+d.slug+"/contribuer";
      }

      function clickAddBrother(d) {
        // window.location.href = "https://"+document.location.hostname+"/arbres/"+d.slug+"/ajouter/"+d.parent.id+"/"+d.user_id;
        window.location.href = "https://"+document.location.hostname+"/arbres/"+d.slug+"/ajouter/"+d.parent.id+"/"+d.user_id;
      }

      function clickShow(d) {
        // window.location.href = "https://"+document.location.hostname+"/arbres/"+d.slug+"/contribution/"+d.slug;
        window.location.href = "https://"+document.location.hostname+"/arbres/"+d.slug+"/contribution/"+d.slug;
      }

      // Hover Bubble
      function hover(d) {
        var index       = d.slug;
        var classe      = ".child-links-"+index;
        var childBuble  = document.getElementById(index);
        var childLink   = d3.selectAll(classe);
        var activeChildBuble = $(".child-bubble.onScene");

        d3.selectAll(".hover").classed('hover', false);
        d3.select(this).classed("hover", true);
        activeChildBuble.removeClass('onScene');

        classie.add(childBuble,"onScene");
        childLink.classed("onScene", true);

      }

      function hoverOut(d) {
        var index   = d.slug;
        var classe      = ".child-links-"+d.slug;
        var childBuble  = document.getElementById(index);
        var childLink   = d3.selectAll(classe);

        childLink.classed("onScene", false);
      }

      function zoomed() {
        svg.attr("transform", "translate(" + d3.event.translate + ")scale(" + d3.event.scale + ")");
      }

      function dragstarted(d) {
        d3.event.sourceEvent.stopPropagation();
        d3.select(this).classed("dragging", true);
      }

      function dragged(d) {
        d3.select(this).attr("cx", d.x = d3.event.x).attr("cy", d.y = d3.event.y);
      }

      function dragended(d) {
        d3.select(this).classed("dragging", false);
      }
    }
  };
}());

// Init the tree
jQuery(document).ready(function($){

  CoolTree.init();

});

