(function ($, Drupal, once) {
  Drupal.behaviors.visTestBehavior = {
    attach: function (context, settings) {
//       once('visTestBehavior', 'div#organizations', context).forEach(function (element) {
        // Apply the myCustomBehaviour effect to the elements only once.
        // create an array with nodes

      var nodes = new vis.DataSet(drupalSettings.visTest.nodeData);
      var edges = new vis.DataSet(drupalSettings.visTest.edgeData);

      this.container = document.getElementById("organizations");

      this.data = {
        nodes: nodes,
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
        },
      };

      function draw() {
        // Clean up old network.
        if (this.network != null) {
          this.network.destroy();
          this.network = null;
        };

        this.network = new vis.Network(this.container, this.data, this.options);
      };

//       Drupal.behaviors.visTestBehavior.draw();
      this.draw();
//       });
    },
//     draw: function() {
//       // Clean up old network.
//       if (Drupal.behaviors.visTestBehavior.network != null) {
//         Drupal.behaviors.visTestBehavior.network.destroy();
//         Drupal.behaviors.visTestBehavior.network = null;
//       };
//
//       Drupal.behaviors.visTestBehavior.network = new vis.Network(container, data, options);
//       };
//     },
    container: null,
    data: null,
    draw: function() {
      this.network = this.reDraw(this.network, this.container, this.data, this.options);
    },
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
