(function ($, Drupal, once) {
  Drupal.behaviors.visTestBehavior = {
    attach: function (context, settings) {
//       once('visTestBehavior', 'div#organizations', context).forEach(function (element) {
        // Apply the myCustomBehaviour effect to the elements only once.
        // create an array with nodes

      this.nodeDataSet = new vis.DataSet(drupalSettings.visTest.nodeData);
      var edges = new vis.DataSet(drupalSettings.visTest.edgeData);

      this.container = document.getElementById("organizations");

      this.data = {
        nodes: this.nodeDataSet,
        edges: edges,
      };
      this.options = {
        nodes: {
          shape: "box",
          scaling: {
            label: {
              min: 16,
              max: 28,
            },
          },
        },
        edges: {
          arrows: "to",
          smooth: {
            type: "vertical",
            forceDirection: "none",
            roundness: 0.9,
          },
        },
        physics: {
          barnesHut: {
            avoidOverlap: 1,
          },
          hierarchicalRepulsion: {
            centralGravity: 0,
            avoidOverlap: 1,
          },
          maxVelocity: 20,
          minVelocity: 0.75,
          solver: "hierarchicalRepulsion",
        },
        interaction: {
          navigationButtons: true,
          keyboard: true,
          hover: true,
        },
//         manipulation: {
//           enabled: true,
//         },
      };


      function draw() {
        // Clean up old network.
        if (this.network != null) {
          this.network.destroy();
          this.network = null;
        };

        this.network = new vis.Network(this.container, this.data, this.options);
      };


      this.draw();
      this.network.on("click", (params) => {
        var nodeId = params.nodes[0]; // 14; // this.getNodeAt(params.pointer.DOM);
//         console.log("click event for node: " + nodeId);
        var node = this.nodeDataSet.get(nodeId);
        console.log(node);
        var dialogModalAjaxObject = Drupal.ajax({
          url: node.clickUrl,
          dialogType: 'modal',
          dialog: { width: '80%', height: '80%', title: node.title },
        });
        dialogModalAjaxObject.execute();
      });
      this.network.on("doubleClick", (params) => {
        var nodeId = params.nodes[0]; // 14; // this.getNodeAt(params.pointer.DOM);
//         console.log("click event for node: " + nodeId);
        var node = this.nodeDataSet.get(nodeId);
        console.log(node);
        var dialogModalAjaxObject = Drupal.ajax({
          url: node.dblClkUrl,
          dialogType: 'modal',
          dialog: { width: '80%', height: '80%', title: node.title },
        });
        dialogModalAjaxObject.execute();
      });

    },
    container: null,
    data: null,
    draw: function() {
      this.network = this.reDraw(this.network, this.container, this.data, this.options);
    },
    nodeDataSet: null,
    network: null,
    options: null,
    reDraw: function(network, container, data, options) {
      // Clean up old network.
      if (network != null) {
        network.destroy();
        network = null;
      };
      network = new vis.Network(container, data, options);
      return network;
    },

  };
})(jQuery, Drupal, once);
