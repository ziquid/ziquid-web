<?php

namespace Drupal\zds_intranet\Controller;

use Drupal\Component\Render\FormattableMarkup;
use Drupal\Component\Utility\Html;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\node\NodeInterface;
use Drupal\taxonomy\TermInterface;
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
   * Intranet home page title.
   *
   * @param int $tid
   *   The term ID from which to start, or 0 for all terms.
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   *
   * @return string
   *   The title.
   */
  public function intranetHomeTitle(int $tid) {
    $title = Link::createFromRoute('ZDS Intranet', 'zds_intranet.intranet_home', [])->toString();
    if ($tid > 0) {
      $term = $this->entityTypeManager->getStorage('taxonomy_term')
        ->load($tid)->get('name')->value;
      $title .= ' :: ' . $term;
    }
    return new FormattableMarkup($title, []);
  }

  /**
   * Intranet home page.
   *
   * @param int $tid
   *   The term ID from which to start, or 0 for all terms.
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   *
   * @return array
   *   The page.
   */
  public function intranetHome(int $tid) {
    $tree = $this->termTree->load('intranet_links', $tid);
    $build = [
      '#attached' => [
        'library' => [
          'zds_intranet/css_styles',
          'zds_intranet/collapse',
        ],
      ],
    ];
    $this->buildTree($tree, $build, 1);
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
      $desc = $item->description__value;
      $term = $this->entityTypeManager->getStorage('taxonomy_term')->load($item->tid);
      $class = Html::getClass('title-' . $item->name);
      $build['wrapper'][$key] = [
        '#prefix' => '<span class="taxo-tree-item tree-level-' . $level . '">',
        'title' => [
          '#prefix' => '<span class="taxo-tree-item-title ' . $class . '">',
          'collapseButton' => [
            '#type' => 'button',
            '#value' => '(+/-)',
            '#attributes' => [
              'onclick' => 'return false;',
            ],
          ],
          'link' => [
            '#type' => 'link',
            '#title' => $item->name,
            '#url' => Url::fromRoute('zds_intranet.intranet_home', ['tid' => $item->tid]),
          ],
          'editLink' => [
            '#type' => 'link',
            '#title' => '(edit)',
            '#url' => $term->toUrl('edit-form', [
              'query' => [
                'destination' => $this->currentUrlWithParams(),
              ],
            ]),
            '#attributes' => [
              'class' => 'taxo-tree-item-node-edit-link',
            ],
          ],
          '#suffix' => '</span>',
        ],
        '#suffix' => '</span>',
      ];
      if (strlen($desc)) {
        $build['wrapper'][$key]['description'] = [
          '#prefix' => '<div class="description">',
          '#markup' => $desc,
          '#suffix' => '</div>',
        ];
      }

      // Any nodes tagged with this term?
      $nids = $this->entityTypeManager->getStorage('node')->getQuery()
        ->latestRevision()
        ->condition('field_intranet_link_term_ref', $item->tid)
        ->execute();
      $nodes = $this->entityTypeManager->getStorage('node')->loadMultiple($nids);

      // Render each node as a link below its term.
      if (count($nodes)) {
        foreach ($nodes as $node) {
          $nodeKey = 'node_' . $node->get('nid')->value;

          // Tagged?  Grab the tag tid and name.
          $tidRef = $node->get('field_intranet_link_tag_ref');
          $tid = NULL;
          if ($tidRef) {
            $tidFirst = $tidRef->first();
            if ($tidFirst) {
              $tid = $tidFirst->target_id;
            }
          }
          if ($tid) {
            $tag = $this->entityTypeManager->getStorage('taxonomy_term')
              ->load($tid)->get('name')->value;
            $tagKey = 'tid_' . $tid;

            if (!array_key_exists($tagKey, $build['wrapper'][$key])) {
              $class = Html::getClass('tag-' . $tag);
              $build['wrapper'][$key][$tagKey] = [
                '#prefix' => '<div class="taxo-tree-item-tag-wrapper tid-' . $tid . '">',
                '#markup' => '<div class="taxo-tree-item-tag ' . $class . '">' . $tag . '</div>',
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
    if (strlen($tag)) {
      $class = Html::getClass('tag-' . $tag . '-node');
    }
    else {
      $class = '';
    }
    try {
      $url = $node->get('field_intranet_link_link')->first()->getUrl();
    }
    catch (\InvalidArgumentException $e) {
      $url = $node->toUrl();
    }
    $array = [
      '#prefix' => '<div class="taxo-tree-item-node ' . $class . '">',
      'link' => [
        '#type' => 'link',
        '#title' => $title,
        '#url' => $url,
        '#attributes' => [
          'target' => '_blank',
        ],
      ],
      'editLink' => [
        '#type' => 'link',
        '#title' => '(edit)',
        '#url' => $node->toUrl('edit-form', [
          'query' => [
            'destination' => $this->currentUrlWithParams(),
          ],
        ]),
        '#attributes' => [
          'class' => 'taxo-tree-item-node-edit-link',
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

  /**
   * Returns the current URL with its current parameters.
   *
   * @see https://agileadam.com/2019/08/rendering-a-drupal-8-link-with-anchor-and-destination/
   *
   * @return string
   *   URL as a string.
   */
  public function currentUrlWithParams() {
    $current_url_options = [
      'query' => \Drupal::request()->query->all(),
    ];

    $current_url = Url::fromRoute(
      '<current>', [], $current_url_options)->toString();

    return $current_url;
  }

}
