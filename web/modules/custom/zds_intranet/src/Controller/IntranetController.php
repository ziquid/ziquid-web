<?php

namespace Drupal\zds_intranet\Controller;

use Drupal\Component\Render\FormattableMarkup;
use Drupal\Component\Serialization\Json;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Render\Markup;
use Drupal\Core\Routing\TrustedRedirectResponse;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\taxonomy_tree\TaxonomyTermTree;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * ZDS Intranet controller.
 */
class IntranetController extends ControllerBase {

  /**
   * @var \Drupal\taxonomy_tree\TaxonomyTermTree
   */
  protected $termTree;

  /**
   * Class constructor.
   *
   * @param \Drupal\taxonomy_tree\TaxonomyTermTree $termTree
   *   The termTree object.
   */
  public function __construct(TaxonomyTermTree $termTree) {
    $this->termTree = $termTree;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('taxonomy_tree.taxonomy_term_tree')
    );
  }

  /**
   * Intranet home page.
   *
   * @return array|string
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

ksm($tree, 'intranet link terms');

//    if (hasCapability('viewSites')) {
//      $build['viewSites'] = [
//        '#prefix' => '<div class="site-home-icon">',
//        'icon' => [
//          '#type' => 'link',
//          '#url' => Url::fromRoute('entity.webform.canonical', ['webform' => 'site_installation_inquiry']),
//          '#title' => Markup::create('<img src="' . $image_path . 'search.png' . '">'),
//          '#attributes' => [
//            'class' => ['site-home-icon'],
//          ],
//        ],
//        'link' => [
//          '#type' => 'link',
//          '#title' => $this->t('Search projects'),
//          '#url' => Url::fromRoute('entity.webform.canonical', ['webform' => 'site_installation_inquiry']),
//          '#attributes' => [
//            'class' => ['site-home-text'],
//          ],
//        ],
//        '#suffix' => '</div>',
//      ];
//    }
//
//    if (hasCapability('viewOrders')) {
//      $build['viewOrders'] = [
//        '#prefix' => '<div class="site-home-icon">',
//        'icon' => [
//          '#type' => 'link',
//          '#url' => Url::fromRoute('entity.webform.canonical', ['webform' => 'search_order']),
//          '#title' => Markup::create('<img src="' . $image_path . 'search.png">'),
//          '#attributes' => [
//            'class' => ['site-home-icon'],
//          ],
//        ],
//        'link' => [
//          '#type' => 'link',
//          '#title' => $this->t('Search orders'),
//          '#url' => Url::fromRoute('entity.webform.canonical', ['webform' => 'search_order']),
//          '#attributes' => [
//            'class' => ['site-home-text'],
//          ],
//        ],
//        '#suffix' => '</div>',
//      ];
//    }

    ksm($build, 'build render array');
    return $build;
  }

  protected function buildTree($tree, &$build, $level) {
    $build['wrapper'] = [
      '#prefix' => '<div class="taxo-tree-wrapper tree-wrapper-level-' . $level . '">',
      '#suffix' => '</div>',
    ];

    foreach ($tree as $key => $item) {
      $build['wrapper'][$key] = [
        '#prefix' => '<span class="taxo-tree-item tree-level-' . $level . '">',
        '#markup' => '<span class="taxo-tree-item-title">' . $item->name . '</span>',
        '#suffix' => '</span>',
      ];

      $nids = \Drupal::entityTypeManager()->getStorage('node')->getQuery()
        ->latestRevision()
        ->condition('field_intranet_link_term_ref', $item->tid)
        ->execute();
      $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadMultiple($nids);

      if (count($nodes)) {
        foreach ($nodes as $node) {
          $build['wrapper'][$key]['node_' . $node->get('nid')->value] = [
            '#prefix' => '<div class="taxo-tree-item-node">',
            'link' => [
              '#type' => 'link',
              '#title' => $node->get('title')->value,
              '#url' => $node->get('field_intranet_link_link')->first()->getUrl(),
              '#attributes' => [
                'target' => '_blank',
              ],
            ],
            '#suffix' => '</div>',
          ];
        }
      }

      if (property_exists($item, 'children') && is_array($item->children)
        && count($item->children) > 0) {
        $this->buildTree($item->children, $build['wrapper'][$key], $level + 1);
      }
    }

  }

}
