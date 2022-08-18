<?php

namespace Drupal\vis_test\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a vis.js test block.
 *
 * @Block(
 *   id = "vis_test_vis_js_test",
 *   admin_label = @Translation("Organizations"),
 *   category = @Translation("PAM")
 * )
 */
class VisJsTestBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build['content'] = [
      'container' => [
        '#type' => 'container',
        '#attributes' => [
          'id' => [
            'organizations',
          ],
        ],
      ],
    ];
    $build['#attached']['library'][] = 'vis_test/visjs-blocksupport';

    $orgData = $this->getOrgTree();
    $build['#attached']['drupalSettings']['visTest'] = $orgData;
    $build['#cache']['tags'][] = 'taxonomy_term_list:account_organization';
    return $build;
  }

  /**
   * Load the account_organization taxonomy tree.
   *
   * @fixme: Move this to a controller that isn't tied to this block.
   */
  protected function getOrgTree() {

    $tree = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree(
      'account_organization', 0, 3, FALSE
    );

    $nodeData = $edgeData = [];
    $nodeData[] = [
      'id' => 0,
      'label' => 'Organizations',
      'value' => 28,
      'margin' => 14,
    ];

//     $numNodesByType = [0, 0, 0];

    foreach ($tree as $term) {
      $nodeData[] = [
        'id' => $term->tid,
        'label' => $term->name,
        'value' => 24 - ($term->depth * 4),
        'margin' => 12 - ($term->depth * 2),
      ];
      $numNodesByType[$term->depth]++;
      if (TRUE || $term->depth > 0) {
        $edgeData[] = [
          'from' => $term->parents[0],
          'to' => $term->tid,
        ];
      }

      // Add a 'root' node if there
    }

    return ['nodeData' => $nodeData, 'edgeData' => $edgeData];
  }
}
