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

    $orgLabels = [
      'Organization',
      'Division',
      'Program',
    ];

    $shortOrgLabels = [
      'Org',
      'Div',
      'Prog',
    ];

    $colors = [
      '#FFA807',
      'lightblue',
      'pink',
    ];

    $nodeData = $edgeData = [];
    $nodeData[] = [
      'id' => 0,
      'label' => 'Organizations',
      'value' => 24,
      'margin' => 14,
    ];
    $nodeData[] = [
      'id' => '0-add-child',
      'label' => '(new)' . "\n" . '`' . $shortOrgLabels[0] . '`',
      'value' => 17,
      'margin' => 10,
      'font' => [
        'multi' => 'md',
      ],
      'shape' => 'ellipse',
      'color' => '#7BE141',
    ];
    $edgeData[] = [
      'from' => 0,
      'to' => '0-add-child',
    ];

//     $numNodesByType = [0, 0, 0];

    foreach ($tree as $term) {
      $label = $term->name;
      $depth = $term->depth;
      if (isset($orgLabels[$depth])) {
        $label .= "\n" . '`' . $orgLabels[$depth] . '`';
      };
      $color = $colors[$depth] ?: $colors[0];

      $nodeData[] = [
        'id' => $term->tid,
        'label' => $label,
        'value' => 20 - ($depth * 3),
        'margin' => 12 - ($depth * 2),
        'font' => [
          'multi' => 'md',
          'align' => 'left',
        ],
        'color' => $color,
      ];

      // Parent?  Show "add" node.
      if ($depth < 2) {
        $label = '(new)';
        if (isset($shortOrgLabels[$depth + 1])) {
          $label .= "\n" . '`' . $shortOrgLabels[$depth + 1] . '`';
        };
        $nodeData[] = [
          'id' => $term->tid . '-add-child',
          'label' => $label,
          'value' => 14 - ($depth * 3),
          'margin' => 8 - ($depth * 2),
          'font' => [
            'multi' => 'md',
          ],
          'shape' => 'ellipse',
          'color' => '#7BE141',
        ];
        $edgeData[] = [
          'from' => $term->tid,
          'to' => $term->tid . '-add-child',
        ];

      };


      $edgeData[] = [
        'from' => $term->parents[0],
        'to' => $term->tid,
      ];

    }

    return ['nodeData' => $nodeData, 'edgeData' => $edgeData];
  }
}
