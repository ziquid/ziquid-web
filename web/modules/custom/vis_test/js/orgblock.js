(function ($, Drupal, once) {
  Drupal.behaviors.visTestBehavior = {
    attach: function (context, settings) {
//       once('visTestBehavior', 'div#organizations', context).forEach(function (element) {
        // Apply the myCustomBehaviour effect to the elements only once.
        // create an array with nodes

      var nodes = new vis.DataSet(drupalSettings.visTest.nodeData);
      var edges = new vis.DataSet(drupalSettings.visTest.edgeData);

      var container = document.getElementById("organizations");

      var data = {
        nodes: nodes,
        edges: edges,
      };
      var options = {
        nodes: {
          shape: "box",
          scaling: {
            label: {
              min: 16,
              max: 24,
            },
          },
        },
        edges: {
          arrows: "to",
          smooth: {
            type: "vertical",
            roundedness: 1,
          }
        }
      };
      var network = new vis.Network(container, data, options);
//       });
    }
  };
})(jQuery, Drupal, once);
