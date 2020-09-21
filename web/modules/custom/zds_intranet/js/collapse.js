/**
 * @file
 */

(function ($, Drupal) {
  Drupal.behaviors.zds_intranet_collapse = {
    attach: function (context, settings) {

      $('.taxo-tree-item-title input.button', context).on('click', function () {
        $(this).parent().parent().toggleClass('collapsed');
      });

    }
  };
})(jQuery, Drupal);
