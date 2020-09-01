<?php

namespace Drupal\zds_intranet\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\node\NodeInterface;
use Drupal\taxonomy_tree\TaxonomyTermTree;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * ZDS Intranet controller.
 */
class IntranetController extends ControllerBase {

  /**
   * Taxonomy Term Tree.
   *
   * @var \Drupal\taxonomy_tree\TaxonomyTermTree
   */
  protected $termTree;

  /**
   * Entity Type Manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManager
   */
  protected $entityTypeManager;

  /**
   * Class constructor.
   *
   * @param \Drupal\taxonomy_tree\TaxonomyTermTree $termTree
   *   The termTree object.
   * @param \Drupal\Core\Entity\EntityTypeManager $entityTypeManager
   *   The entity type manager.
   */
  public function __construct(TaxonomyTermTree $termTree, EntityTypeManager $entityTypeManager) {
    $this->termTree = $termTree;
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('taxonomy_tree.taxonomy_term_tree'),
      $container->get('entity_type.manager')
    );
  }

  /**
   * Intranet home page.
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   *
   * @return array
   *   The page.
   */
  public function intranetHome() {
    $tree = $this->termTree->load('intranet_links');
    $build = [
      '#attached' => [
        'library' => [
          'zds_intranet/css_styles',
        ],
      ],
    ];
    $this->buildTree($tree, $build, 1);
    ksm($build, 'build');
    return $build;
  }

  /**
   * Build the tree of terms/nodes.
   *
   * @param object[] $tree
   *   The tree objects.
   * @param array $build
   *   The build render array.
   * @param int $level
   *   The level of the tree to build.
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  protected function buildTree(array $tree, array &$build, $level) {

    // Each level gets a wrapper div.
    $build['wrapper'] = [
      '#prefix' => '<div class="taxo-tree-wrapper tree-wrapper-level-' . $level . '">',
      '#suffix' => '</div>',
    ];

    // And spans for each term at that level.
    foreach ($tree as $key => $item) {
      $build['wrapper'][$key] = [
        '#prefix' => '<span class="taxo-tree-item tree-level-' . $level . '">',
        '#markup' => '<span class="taxo-tree-item-title">' . $item->name . '</span>',
        '#suffix' => '</span>',
      ];

      // Any nodes tagged with this term?
      $nids = \Drupal::entityTypeManager()->getStorage('node')->getQuery()
        ->latestRevision()
        ->condition('field_intranet_link_term_ref', $item->tid)
        ->execute();
      $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadMultiple($nids);

      // Render each node as a link below its term.
      if (count($nodes)) {
        foreach ($nodes as $node) {
          $nodeKey = 'node_' . $node->get('nid')->value;

          // Tagged?  Grab the tag tid and name.
          $tid = $node->get('field_intranet_link_tag_ref')->first()->target_id;
          if ($tid) {
            $tag = \Drupal::entityTypeManager()->getStorage('taxonomy_term')
              ->load($tid)->get('name')->value;
            $tagKey = 'tid_' . $tid;

            if (!array_key_exists($tagKey, $build['wrapper'][$key])) {
              $build['wrapper'][$key][$tagKey] = [
                '#prefix' => '<div class="taxo-tree-item-tag-wrapper tid-' . $tid . '">',
                '#markup' => '<h3 class="taxo-tree-item-tag">' . $tag . '</h3>',
                '#suffix' => '</div>',
              ];
            }
            $build['wrapper'][$key][$tagKey][$nodeKey] = $this->nodeBuild($node, $tag);
          }
          else {
            $build['wrapper'][$key][$nodeKey] = $this->nodeBuild($node);
          }
        }
      }

      if (property_exists($item, 'children') && is_array($item->children)
        && count($item->children) > 0) {
        $this->buildTree($item->children, $build['wrapper'][$key], $level + 1);
      }
    }

  }

  /**
   * Build a render array from a node.
   *
   * @param \Drupal\node\NodeInterface $node
   *   The node to build for.
   * @param string $tag
   *   The tag to use in building the array.
   *
   * @return array
   *   The render array.
   */
  protected function nodeBuild(NodeInterface $node, string $tag = '') {
    $title = $node->get('title')->value;
    $desc = $node->get('body')->value;
    $array = [
      '#prefix' => '<div class="taxo-tree-item-node">',
      'link' => [
        '#type' => 'link',
        '#title' => $title,
        '#url' => $node->get('field_intranet_link_link')->first()->getUrl(),
        '#attributes' => [
          'target' => '_blank',
        ],
      ],
      '#suffix' => '</div>',
    ];

    if (strlen($desc)) {
      $array['description'] = [
        '#prefix' => '<div class="description">',
        '#markup' => $desc,
        '#suffix' => '</div>',
      ];
    }

    return $array;
  }

}
