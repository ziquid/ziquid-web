<?php
$form['color']['color_tab'] = [
  '#type'  => 'vertical_tabs',
];
// Color -> Sub tabs
$form['color']['color_theme'] = [
  '#type'        => 'details',
  '#title'       => t('Theme Base'),
  '#group' => 'color_tab',
];
$form['color']['color_header'] = [
  '#type'        => 'details',
  '#title'       => t('Header'),
  '#group' => 'color_tab',
];
// Color -> Theme Base Colors
$form['color']['color_theme']['color_scheme_section'] = [
  '#type'        => 'details',
  '#title'       => t('Use Default Colors'),
  '#attributes' => array('class' => array('set-default-fieldset')),
  '#open' => TRUE,
];
$form['color']['color_theme']['color_scheme_section']['color_scheme_use'] = [
  '#type'          => 'checkbox',
  '#title'         => t('Use default color scheme.'),
  '#default_value' => theme_get_setting('color_scheme_use'),
  '#description'   => t("Check this option to use default colors. Uncheck to customize theme base colors below."),
];
$form['color']['color_theme']['color_base'] = [
  '#type'        => 'details',
  '#title'       => t('Customize Theme Base Colors'),
  '#open' => TRUE,
];
$form['color']['color_theme']['color_base']['theme_color_one'] = [
  '#type'        => 'color',
  '#field_suffix' => theme_get_setting('theme_color_one'),
  '#title'       => t('Primary Theme Color'),
  '#default_value' => theme_get_setting('theme_color_one'),
  '#description' => t('<p>Default value is <strong>#97C2B8</strong></p><p><hr /></p>'),
];
$form['color']['color_theme']['color_base']['theme_color_two'] = [
  '#type'        => 'color',
  '#field_suffix' => theme_get_setting('theme_color_two'),
  '#title'       => t('Secondary Theme Color'),
  '#default_value' => theme_get_setting('theme_color_two'),
  '#description' => t('<p>Default value is <strong>#F9AB51</strong></p><p><hr /></p>'),
];
$form['color']['color_theme']['color_base']['theme_color_dark'] = [
  '#type'        => 'color',
  '#field_suffix' => theme_get_setting('theme_color_dark'),
  '#title'       => t('Dark Color'),
  '#default_value' => theme_get_setting('theme_color_dark'),
  '#description' => t('<p>Default value is <strong>#628B82</strong></p><p><hr /></p>'),
];
$form['color']['color_theme']['color_base']['theme_color_light'] = [
  '#type'        => 'color',
  '#field_suffix' => theme_get_setting('theme_color_light'),
  '#title'       => t('Light Color'),
  '#default_value' => theme_get_setting('theme_color_light'),
  '#description' => t('<p>Default value is <strong>#F4FCFA</strong></p><p><hr /></p>'),
];
$form['color']['color_theme']['color_base']['theme_color_border'] = [
  '#type'        => 'color',
  '#field_suffix' => theme_get_setting('theme_color_border'),
  '#title'       => t('Border and Divider Color'),
  '#default_value' => theme_get_setting('theme_color_border'),
  '#description' => t('<p>Default value is <strong>#D2EFE8</strong></p><p><hr /></p>'),
];
$form['color']['color_theme']['color_base']['color_bodybg'] = [
  '#type'        => 'color',
  '#field_suffix' => theme_get_setting('color_bodybg'),
  '#title'       => t('Body Background Color'),
  '#default_value' => theme_get_setting('color_bodybg'),
  '#description' => t('<p>Default value is <strong>#ffffff</strong></p><p><hr /></p>'),
];
$form['color']['color_theme']['color_base']['color_bodytext'] = [
  '#type'        => 'color',
  '#field_suffix' => theme_get_setting('color_bodytext'),
  '#title'       => t('Text Color'),
  '#default_value' => theme_get_setting('color_bodytext'),
  '#description' => t('<p>Default value is <strong>#383549</strong></p><p><hr /></p>'),
];
$form['color']['color_theme']['color_base']['color_bold'] = [
  '#type'        => 'color',
  '#field_suffix' => theme_get_setting('color_bold'),
  '#title'       => t('Bold and Heading Color'),
  '#default_value' => theme_get_setting('color_bold'),
  '#description' => t('<p>Default value is <strong>#111111</strong></p><p><hr /></p>'),
];

// Color -> Header -> Sticky Header
$form['color']['color_header']['color_header_sticky_section'] = [
  '#type'        => 'details',
  '#title'       => t('Sticky Header'),
  '#open' => TRUE,
];
$form['color']['color_header']['color_header_sticky_section']['color_header_sticky'] = [
  '#type'        => 'color',
  '#field_suffix' => theme_get_setting('color_header_sticky'),
  '#title'       => t('Sticky Header Background Color'),
  '#default_value' => theme_get_setting('color_header_sticky'),
  '#description' => t('<p>Default value is <strong>#dddddd</strong></p><p><hr /></p>'),
];