<?php

/**
 * @file
 * Lists available colors and color schemes for the ZuviPro theme.
 */

$info = [
  // Available colors and color labels used in theme.
  'fields' => [
    'top' => t('Header and Footer background'),
    'bottom' => t('Block Regions background'),
    'bg' => t('Body background'),
    // 'sidebar' => t('Sidebar background'),
    'sidebarborders' => t('Border Color'),
    // 'footer' => t('Footer background'),
    // 'titleslogan' => t('Title and slogan'),
    'text' => t('Text color'),
    'link' => t('Theme Color First'),
    'themes' => t('Theme Color Second'),
    'circle' => t('Header Animated Circle Color'),
  ],
  // Pre-defined color schemes.
  'schemes' => [
    'default' => [
      'title' => t('ZuviPro Default'),
      'colors' => [
        'top' => '#020312',
        'bottom' => '#181a25',
        'bg' => '#0d0f16',
        'sidebarborders' => '#282d38',
        'text' => '#a1a1a1',
        'link' => '#f26c4f',
        'themes' => '#f4399e',
        'circle' => '#510a31'
      ]
    ]
  ],

  // CSS files (excluding @import) to rewrite with new color scheme.
  'css' => [
    'css/colors.css',
  ],

  // Files to copy.
  'copy' => [
    'logo.svg',
  ],

  // Gradient definitions.
  'gradients' => [
    [
      // (x, y, width, height).
      'dimension' => [0, 0, 0, 0],
      // Direction of gradient ('vertical' or 'horizontal').
      'direction' => 'vertical',
      // Keys of colors to use for the gradient.
      'colors' => ['top', 'bottom'],
    ],
  ],

  // Preview files.
  'preview_library' => 'zuvipro/color.preview',
  'preview_html' => 'color/preview.html',

  // Attachments.
  '#attached' => [
    'drupalSettings' => [
      'color' => [
        // Put the logo path into JavaScript for the live preview.
        'logo' => theme_get_setting('logo.url', 'zuvipro'),
      ],
    ],
  ],
];
