<?php

/**
 * @file
 * Custom setting for ZuviPro theme.
 */

function zuvipro_form_system_theme_settings_alter(&$form, &$form_state) {
  $theme_update_info = file_get_contents("https://drupar.com/theme-update-info/zuvipro.txt");
  $form['zuvipro'] = [
    '#type'       => 'vertical_tabs',
    '#title'      => '<h3>' . t('ZuviPro Theme Settings') . '</h3>',
    '#default_tab' => 'general',
  ];

  /**
   * Main Tabs.
   */

  // Main Tabs -> General.
  $form['general'] = [
    '#type'  => 'details',
    '#title' => t('General'),
    '#description' => t('<h3>Thanks for using ZuviPro Theme</h3>ZuviPro is a premium Drupal 8 theme designed and developed by <a href="https://drupar.com" target="_blank">Drupar.com</a>'),
    '#group' => 'zuvipro',
  ];

  // Main Tabs -> Social.
  $form['social'] = [
    '#type'  => 'details',
    '#title' => t('Social'),
    '#group' => 'zuvipro',
  ];

  // Main Tabs -> Homepage Slider.
  $form['slider'] = [
    '#type'  => 'details',
    '#title' => t('Homepage Slider'),
    '#description' => t('Manage homepage slider.'),
    '#group' => 'zuvipro',
  ];

  // Main Tabs -> Header.
  $form['header'] = [
    '#type'  => 'details',
    '#title' => t('Header'),
    '#group' => 'zuvipro',
  ];

  // Main Tabs -> Sidebar.
  $form['sidebar'] = [
    '#type'  => 'details',
    '#title' => t('Sidebar'),
    '#group' => 'zuvipro',
  ];

  // Main Tabs -> Content.
  $form['content'] = [
    '#type'  => 'details',
    '#title' => t('Content'),
    '#group' => 'zuvipro',
  ];

  // Main Tabs -> Footer.
  $form['footer'] = [
    '#type'  => 'details',
    '#title' => t('Footer'),
    '#group' => 'zuvipro',
  ];
  // Main Tabs ->Insert codes
  $form['insert_codes'] = [
    '#type'  => 'details',
    '#title' => t('Insert Codes'),
    '#group' => 'zuvipro',
  ];
  // Main Tabs -> Licensing.
  $form['license'] = [
    '#type'  => 'details',
    '#title' => t('Theme License'),
    '#group' => 'zuvipro',
  ];

  // Main Tabs -> Update.
  $form['update'] = [
    '#type'  => 'details',
    '#title' => t('Update'),
    '#description' => t('<h4>Check For Update</h4>'),
    '#group' => 'zuvipro',
  ];

  // Main Tabs -> Support.
  $form['support'] = [
    '#type'  => 'details',
    '#title' => t('Support'),
    '#description' => t('<h4>Support</h4><p>For any support related to ZuviPro theme, please <a href="https://drupar.com/node/add/ticket" target="_blank">open a support ticket</a>.</p>'),
    '#group' => 'zuvipro',
  ];

  // General -> info.
  // General tab -> Theme version info.
  $form['general']['theme_version'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Current Theme Version'),
    '#description' => t('8.2.0'),
  ];
  $form['general']['general_info'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Theme Info'),
    '#description' => t('<a href="https://www.drupar.com/theme/zuvipro" target="_blank">Theme Homepage</a> || <a href="//demo2.drupar.com/zuvipro/" target="_blank">Theme Demo</a> || <a href="https://www.drupar.com/zuvipro-documentation" target="_blank">Theme Documentation</a> || <a href="https://www.drupar.com/zuvipro-documentation/support" target="_blank">Theme Support</a>'),
  ];

  // Settings under social tab.
  // Show or hide all icons.
  $form['social']['social_profile'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Social Profile'),
  ];
  $form['social']['social_profile']['all_icons'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Show Social Icons'),
  ];
  $form['social']['social_profile']['all_icons']['all_icons_show'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Show social icons in footer'),
    '#default_value' => theme_get_setting('all_icons_show', 'zuvipro'),
    '#description'   => t("Check this option to show social icons in footer. Uncheck to hide all icons. Below you can hide individual icons."),
  ];

  // Facebook.
    $form['social']['social_profile']['facebook'] = [
    '#type'        => 'details',
    '#title'       => t("Facebook"),
  ];

  $form['social']['social_profile']['facebook']['facebook_url'] = [
    '#type'          => 'textfield',
    '#title'         => t('Facebook Url'),
    '#description'   => t("Enter yours facebook profile or page url. Leave the url field blank to hide this icon."),
    '#default_value' => theme_get_setting('facebook_url', 'zuvipro'),
  ];

  // Twitter.
  $form['social']['social_profile']['twitter'] = [
    '#type'        => 'details',
    '#title'       => t("Twitter"),
  ];

  $form['social']['social_profile']['twitter']['twitter_url'] = [
    '#type'          => 'textfield',
    '#title'         => t('Twitter Url'),
    '#description'   => t("Enter yours twitter page url. Leave the url field blank to hide this icon."),
    '#default_value' => theme_get_setting('twitter_url', 'zuvipro'),
  ];

  // Instagram.
  $form['social']['social_profile']['instagram'] = [
    '#type'        => 'details',
    '#title'       => t("Instagram"),
  ];

  $form['social']['social_profile']['instagram']['instagram_url'] = [
    '#type'          => 'textfield',
    '#title'         => t('Instagram Url'),
    '#description'   => t("Enter yours instagram page url. Leave the url field blank to hide this icon."),
    '#default_value' => theme_get_setting('instagram_url', 'zuvipro'),
  ];

  // Linkedin.
  $form['social']['social_profile']['linkedin'] = [
    '#type'        => 'details',
    '#title'       => t("Linkedin"),
  ];

  $form['social']['social_profile']['linkedin']['linkedin_url'] = [
    '#type'          => 'textfield',
    '#title'         => t('Linkedin Url'),
    '#description'   => t("Enter yours linkedin page url. Leave the url field blank to hide this icon."),
    '#default_value' => theme_get_setting('linkedin_url', 'zuvipro'),
  ];

  // YouTube.
  $form['social']['social_profile']['youtube'] = [
    '#type'        => 'details',
    '#title'       => t("YouTube"),
  ];

  $form['social']['social_profile']['youtube']['youtube_url'] = [
    '#type'          => 'textfield',
    '#title'         => t('YouTube Url'),
    '#description'   => t("Enter yours youtube.com page url. Leave the url field blank to hide this icon."),
    '#default_value' => theme_get_setting('youtube_url', 'zuvipro'),
  ];

  // vimeo.
  $form['social']['social_profile']['vimeo'] = [
    '#type'        => 'details',
    '#title'       => t("vimeo"),
  ];

  $form['social']['social_profile']['vimeo']['vimeo_url'] = [
    '#type'          => 'textfield',
    '#title'         => t('vimeo Url'),
    '#description'   => t("Enter yours vimeo.com page url. Leave the url field blank to hide this icon."),
    '#default_value' => theme_get_setting('vimeo_url', 'zuvipro'),
  ];

  // telegram.
    $form['social']['social_profile']['telegram'] = [
    '#type'        => 'details',
    '#title'       => t("Telegram"),
  ];

  $form['social']['social_profile']['telegram']['telegram_url'] = [
    '#type'          => 'textfield',
    '#title'         => t('Telegram Url'),
    '#description'   => t("Enter yours Telegram profile or page url. Leave the url field blank to hide this icon."),
    '#default_value' => theme_get_setting('telegram_url', 'zuvipro'),
  ];

  // WhatsApp.
    $form['social']['social_profile']['whatsapp'] = [
    '#type'        => 'details',
    '#title'       => t("WhatsApp"),
  ];

  $form['social']['social_profile']['whatsapp']['whatsapp_url'] = [
    '#type'          => 'textfield',
    '#title'         => t('WhatsApp Url'),
    '#description'   => t("Enter yours whatsapp message url. Leave the url field blank to hide this icon."),
    '#default_value' => theme_get_setting('whatsapp_url', 'zuvipro'),
  ];

  // Github.
    $form['social']['social_profile']['github'] = [
    '#type'        => 'details',
    '#title'       => t("GitHub"),
  ];

  $form['social']['social_profile']['github']['github_url'] = [
    '#type'          => 'textfield',
    '#title'         => t('GitHub Url'),
    '#description'   => t("Enter yours github page url. Leave the url field blank to hide this icon."),
    '#default_value' => theme_get_setting('github_url', 'zuvipro'),
  ];

  // Social -> vk.com url.
  $form['social']['social_profile']['vk'] = [
    '#type'        => 'details',
    '#title'       => t("vk.com"),
  ];
  $form['social']['social_profile']['vk']['vk_url'] = [
      '#type'          => 'textfield',
      '#title'         => t('vk.com'),
      '#description'   => t("Enter yours vk.com page url. Leave the url field blank to hide this icon."),
      '#default_value' => theme_get_setting('vk_url', 'zuvipro'),
  ];

  // Social -> New Social Icons
  $form['social']['social_new_icon'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Add More Social Icons'),
  ];

  $form['social']['social_new_icon']['social_new_icon_code'] = [
    '#type'          => 'textarea',
    '#title'         => t('New Social Icons Code'),
    '#default_value' => theme_get_setting('social_new_icon_code', 'zuvipro'),
    '#description'   => t('Please refer to this <a href="https://www.drupar.com/zuvipro-documentation/social-icons-footer" target="_blank">documentation page</a> for social icons code tutorial.'),
  ];

  // Social-> Node sharing option.
  $form['social']['page_share'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Node Sharing on Social networking websites'),
  ];
  $form['social']['page_share']['page_share_all'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Enable Node Sharing Feature'),
    '#default_value' => theme_get_setting('page_share_all', 'zuvipro'),
    '#description'   => t("Check this option to enable site wide social sharing. Below you can enable or disable for individual content type and frontpage. Uncheck to disable this feature for all pages."),
  ];

  $form['social']['page_share']['page_share_front'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Share Homepage'),
    '#default_value' => theme_get_setting('page_share_front', 'zuvipro'),
    '#description'   => t("Check this option to show social sharing buttons (facebook, twitter, Instagram etc) on <strong>Homepage</strong>. Uncheck to hide."),
  ];

  $form['social']['page_share']['page_share_page'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Share Page Content Type'),
    '#default_value' => theme_get_setting('page_share_page', 'zuvipro'),
    '#description'   => t("Check this option to show social sharing buttons (facebook, twitter, Instagram etc) on <strong>Basic page</strong> content type nodes. Uncheck to hide."),
  ];

  $form['social']['page_share']['page_share_article'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Share Article Content Type'),
    '#default_value' => theme_get_setting('page_share_article', 'zuvipro'),
    '#description'   => t("Check this option to show social sharing buttons (facebook, twitter, Instagram etc) on <strong>Article</strong> content type nodes. Uncheck to hide."),
  ];

  $form['social']['page_share']['page_share_book'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Share Book Pages'),
    '#default_value' => theme_get_setting('page_share_book', 'zuvipro'),
    '#description'   => t("Check this option to show social sharing buttons (facebook, twitter, Instagram etc) on <strong>Book</strong> type nodes. Uncheck to hide."),
  ];

  $form['social']['page_share']['page_share_other'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Share Other Content Types'),
    '#default_value' => theme_get_setting('page_share_other', 'zuvipro'),
    '#description'   => t("Check this option to show social sharing buttons (facebook, twitter, Instagram etc) on other content type nodes. Uncheck to hide."),
  ];

  /**
   * Settings under slider tab.
   */
  // Show or hide slider on homepage.
  $form['slider']['slider_enable_option'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Enable Slider'),
  ];

  $form['slider']['slider_enable_option']['slider_show'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Show Slider on Homepage'),
    '#default_value' => theme_get_setting('slider_show', 'zuvipro'),
    '#description'   => t("Check this option to show slider on homepage. Uncheck to hide."),
  ];

  // Slider -> Slider interval time.
  $form['slider']['time'] = [
    '#type'          => 'fieldset',
    '#title'         => t('Slider Interval Time'),
  ];
  $form['slider']['time']['slider_time'] = [
    '#type'          => 'number',
    '#title'         => t('Autoplay Interval Time'),
    '#default_value' => theme_get_setting('slider_time', 'zuvipro'),
    '#description'   => t('Default value is 10000, this means 10 seconds.'),
  ];

  // Slider -> Slider dots option.
  $form['slider']['slider_dots_field'] = [
    '#type'          => 'fieldset',
    '#title'         => t('Slider Dots Navigation'),
  ];
  $form['slider']['slider_dots_field']['slider_dots'] = [
    '#type'          => 'select',
    '#title'         => t('Show or Hide Slider Dots Navigation'),
    '#options' => array(
      'true' => t('Show'),
      'false' => t('Hide'),),
    '#default_value' => theme_get_setting('slider_dots', 'zuvipro'),
    '#description'   => t('Show or hide slider dots navigation that appears at the bottom of slider.'),
  ];

  // Slider -> Slider dots option.
  $form['slider']['slider_nav_field'] = [
    '#type'          => 'fieldset',
    '#title'         => t('Slider Nav Arrow'),
  ];
  $form['slider']['slider_nav_field']['slider_nav'] = [
    '#type'          => 'select',
    '#title'         => t('Show or Hide Slider Nav Arrow'),
    '#options' => array(
      'true' => t('Show'),
      'false' => t('Hide'),),
    '#default_value' => theme_get_setting('slider_nav', 'zuvipro'),
    '#description'   => t('Show or hide slider navigation arrow for previous and next slide.'),
  ];

  // Homepage -> Slider -> Bottom wave shape
  $form['slider']['slider_bottom_wave'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Slider Bottom Wave Shape'),
  ];

  $form['slider']['slider_bottom_wave']['slider_wave'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Show Slider Bottom Wave Shape'),
    '#default_value' => theme_get_setting('slider_wave', 'zuvipro'),
    '#description'   => t("Check this option to show slider bottom wave shape. Uncheck to hide."),
  ];

  $form['slider']['slider_code'] = [
    '#type'          => 'textarea',
    '#title'         => t('Slider Code'),
    '#default_value' => theme_get_setting('slider_code', 'zuvipro'),
    '#description'   => t('Please refer to this <a href="https://www.drupar.com/zuvipro-documentation/homepage-slider" target="_blank">documentation page</a> for slider code tutorial.'),
  ];

  // Settings under header tab.
  // Header -> sticky header.
  $form['header']['sticky_header'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Sticky Header'),
  ];
  $form['header']['sticky_header']['sticky_header_option'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Enable Sticky Header'),
    '#default_value' => theme_get_setting('sticky_header_option', 'zuvipro'),
    '#description'   => t("Check this option to enable sticky header. Uncheck to disable."),
  ];

  // Header -> Animated circles
  $form['header']['circle'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Animated Circles in Header'),
  ];
  $form['header']['circle']['header_circle_slider'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Show Animated Circles in Slider'),
    '#default_value' => theme_get_setting('header_circle_slider', 'zuvipro'),
    '#description'   => t("Check this option to show animated circles in header. Uncheck to disable."),
  ];
  $form['header']['circle']['header_circle_header'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Show Animated Circles in Inner Pages Header'),
    '#default_value' => theme_get_setting('header_circle_header', 'zuvipro'),
    '#description'   => t("Check this option to show animated circles in header. Uncheck to disable."),
  ];
  $form['header']['circle_style'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Solid or Border Animated Circles'),
    '#description'   => t('Select header animated circles type. You can set border circles or solid circles.'),
  ];
  $form['header']['circle_style']['circle_type'] = [
    '#type'          => 'select',
    '#title'         => t(''),
    '#options' => array(
      'circle_border' => t('Border'),
      'circle_solid' => t('Solid'),),
    '#default_value' => theme_get_setting('circle_type', 'zuvipro'),
    '#description'   => t(''),
  ];
  // Settings under sidebar.
  $form['sidebar']['front_sidebar_section'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Homepage Sidebar'),
  ];
  $form['sidebar']['front_sidebar_section']['front_sidebar'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Show Sidebars On Homepage'),
    '#default_value' => theme_get_setting('front_sidebar'),
    '#description'   => t("<p>Check this option to enable left and right sidebar on homepage.</p><hr /><br /><strong>Homepage Content</strong> block regions will always be full width."),
  ];
  $form['sidebar']['animated_sidebar'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Animated Sidebar'),
  ];
  $form['sidebar']['animated_sidebar']['animated_sidebar_option'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Enable animated sidebar'),
    '#default_value' => theme_get_setting('animated_sidebar_option', 'zuvipro'),
    '#description'   => t("Check this option to enable animated sidebar feature. Uncheck to hide.<br />Please refer to this tutorial for details. <a href='https://www.drupar.com/zuvipro-documentation/how-create-animated-sidebar' target='_blank'>How To Create Animated Sidebar</a>"),
  ];

  // Settings under content tab.
  // Content -> Google Fonts.
  $form['content']['google_font_section'] = [
    '#type'          => 'fieldset',
    '#title'         => t('Google Fonts Source'),
  ];
  $form['content']['google_font_section']['google_font'] = [
    '#type'          => 'select',
    '#title'         => t('Select Google Fonts Location'),
    '#options' => array(
    	'local' => t('Local Self Hosted'),
      'googlecdn' => t('Google CDN Server')
    ),
    '#default_value' => theme_get_setting('google_font'),
    '#description'   => t('ZuviPro theme uses following Google fonts: Open Sans and Roboto. You can serve these fonts locally or from Google server.'),
  ];
  // Content -> Page Loading.
  $form['content']['preloader'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Pre Page Loader'),
  ];
  $form['content']['preloader']['preloader_option'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Show a loading icon before page loads.'),
    '#default_value' => theme_get_setting('preloader_option', 'zuvipro'),
    '#description'   => t("Check this option to show a cool animated image until your website is loading. Uncheck to disable this feature."),
  ];

  // Content -> Page Loading.
  $form['content']['cursor'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Fancy Cursor'),
  ];
  $form['content']['cursor']['fancy_cursor'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Enable fancy circle around mouse cursor.'),
    '#default_value' => theme_get_setting('fancy_cursor', 'zuvipro'),
    '#description'   => t("Check this option to add a fancy animated circle around the mouse cursor. Uncheck to disable this feature."),
  ];

  // Settings under content tab -> Homepage.
  $form['content']['homepage'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Homepage Content'),
    '#description'   => t('Please follow this tutorial to add content on homepage. <a href="https://www.drupar.com/zuvipro-documentation/how-add-content-homepage" target="_blank">How to add content on homepage</a>'),
  ];

  // Settings under content tab -> Animated Content.
  $form['content']['animated_content_in_view'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Animated Page Content'),
    '#description'   => t('<p><hr /></p><p>Please visit this tutorial page for details. <a href="https://www.drupar.com/zuvipro-documentation/how-create-animated-content" target="_blank">How to create animated content</a>.</p>'),
  ];

  $form['content']['animated_content_in_view']['animated_content'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Enable Animated Page Content when in view'),
    '#default_value' => theme_get_setting('animated_content', 'zuvipro'),
    '#description'   => t("Check this option to enable animated page content when in view. Uncheck to disable this feature."),
  ];

  // Settings under content tab -> Font Icons.
  $form['content']['font_icons'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Font Icons'),
  ];

  // Settings under content tab -> Font Icons -> FontAwesome
  $form['content']['font_icons']['font_icon_fontawesome'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Font Awesome'),
    '#default_value' => theme_get_setting('font_icon_fontawesome', 'zuvipro'),
    '#description'   => t('Check this option to enable FontAwesome font icons. Uncheck to disable.<br /><br />zuvipro theme has included FontAwesome v4.7.0 font icons. You can use any FontAwesome font icon with zuvipro theme.<br />Please visit this tutorial page for details. <a href="https://www.drupar.com/custom-shortcodes-set-two/fontawesome-font-icons" target="_blank">How To Use FontAwesome Font Icons</a>.<br /><br /><hr /><br />'),
  ];

  $form['content']['font_icons']['fontawesome_five'] = [
    '#type'          => 'checkbox',
    '#title'         => t('FontAwesome 5 Font Icons'),
    '#default_value' => theme_get_setting('fontawesome_five'),
    '#description'   => t("Check this option to enable FontAwesome 5 Font Icons. Uncheck to disable.<br /><br /><hr /><br />"),
  ];
  // Settings under content tab -> Font Icons -> Google Material Icons
  $form['content']['font_icons']['font_icon_material'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Google Material Font Icons'),
    '#default_value' => theme_get_setting('font_icon_material', 'zuvipro'),
    '#description'   => t('Check this option to enable Google Material font icons. Uncheck to disable.<br /><br /><br />zuvipro theme has included Google material font icons. You can use any Google material icon with zuvipro theme.<br />Please visit this tutorial page for details. <a href="https://www.drupar.com/zuvipro-documentation/font-icons" target="_blank">How To Use Google Material Font Icons</a>.'),
  ];

  // Node author picture.
  $form['content']['node'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Node'),
  ];

  $form['content']['node']['node_author_pic'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Node Author Picture'),
    '#default_value' => theme_get_setting('node_author_pic', 'zuvipro'),
    '#description'   => t("Check this option to show node author picture in submitted details. Uncheck to hide."),
  ];

  // Show tags in node submitted.
  $form['content']['node']['node_tags'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Node Tags'),
    '#default_value' => theme_get_setting('node_tags', 'zuvipro'),
    '#description'   => t("Check this option to show node tags (if any) in submitted details. Uncheck to hide."),
  ];

  // Show user picture in comment.
  $form['content']['comment'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Comment'),
  ];

  $form['content']['comment']['comment_user_pic'] = [
    '#type'          => 'checkbox',
    '#title'         => t('User Picture in comments'),
    '#default_value' => theme_get_setting('comment_user_pic', 'zuvipro'),
    '#description'   => t("Check this option to show user picture in comment. Uncheck to hide."),
  ];

  // Settings under footer tab.
  // Scroll to top.
  $form['footer']['scrolltotop'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Scroll To Top'),
  ];

  $form['footer']['scrolltotop']['scrolltotop_on'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Enable scroll to top feature.'),
    '#default_value' => theme_get_setting('scrolltotop_on', 'zuvipro'),
    '#description'   => t("Check this option to enable scroll to top feature. Uncheck to disable this fearure and hide scroll to top icon."),
  ];

  $form['footer']['footer_wave_shape'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Footer Wave Shape'),
  ];

  $form['footer']['footer_wave_shape']['footer_wave'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Show Footer Wave Shape'),
    '#default_value' => theme_get_setting('footer_wave', 'zuvipro'),
    '#description'   => t("Check this option to show footer top wave shape. Uncheck to hide."),
  ];

  // Footer -> Copyright.
  $form['footer']['copyright'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Website Copyright Text'),
  ];

  $form['footer']['copyright']['copyright_text'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Show website copyright text in footer.'),
    '#default_value' => theme_get_setting('copyright_text', 'zuvipro'),
    '#description'   => t("Check this option to show website copyright text in footer. Uncheck to hide."),
  ];

  // Footer -> copyright -> custom copyright text
  $form['footer']['copyright']['copyright_text_custom'] = [
    '#type'          => 'textarea',
    '#title'         => t('Custom Copyright Text'),
    '#default_value' => theme_get_setting('copyright_text_custom', 'zuvipro'),
    '#description'   => t("Enter custom copyright text. Leave it blank to show default copyright text."),
  ];

  // Footer -> Cookie.
  $form['footer']['cookie'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Cookie Consent message'),
  ];
  $form['footer']['cookie']['cookie_message'] = [
    '#type'          => 'checkbox',
    '#title'       => t('Show Cookie Consent Popup Message'),
    '#default_value' => theme_get_setting('cookie_message', 'zuvipro'),
    '#description'   => t('Required to place a Cookie Consent message on your site, as per the EU cookie law? Make your website EU Cookie Law Compliant.<br />According to EU cookies law, websites need to get consent from visitors to store or retrieve cookies.'),
  ];

  // Footer -> Cookie -> custom cookie message.
  $form['footer']['cookie']['cookie_message_custom'] = [
    '#type'          => 'textarea',
    '#title'         => t('Custom Cookie Consent Message'),
    '#default_value' => theme_get_setting('cookie_message_custom', 'zuvipro'),
    '#description'   => t("Enter Cookie Consent Message. Leave it blank to show default message text."),
  ];

  /**
   * Insert Codes
   */
  $form['insert_codes']['insert_codes_tab'] = [
    '#type'  => 'vertical_tabs',
  ];
  // Insert Codes -> Head
  $form['insert_codes']['head'] = [
    '#type'        => 'details',
    '#title'       => t('Head'),
    '#description' => t('<h3>Insert Codes Before &lt;/HEAD&gt;</h3><hr />'),
    '#group' => 'insert_codes_tab',
  ];
  // Insert Codes -> Body
  $form['insert_codes']['body'] = [
    '#type'        => 'details',
    '#title'       => t('Body'),
    '#group' => 'insert_codes_tab',
  ];
  // Insert Codes -> CSS
  $form['insert_codes']['css'] = [
    '#type'        => 'details',
    '#title'       => t('CSS Codes'),
    '#group'       => 'insert_codes_tab',
  ];
  // Insert Codes -> Head -> Head codes
  $form['insert_codes']['head']['insert_head'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Enable custom codes in &lt;head&gt; section'),
    '#default_value' => theme_get_setting('insert_head'),
    '#description'   => t("Check this option to enable custom codes in &lt;head&gt; section. Uncheck to disable this feature."),
  ];
  $form['insert_codes']['head']['head_code'] = [
    '#type'          => 'textarea',
    '#title'         => t('&lt;head&gt; Codes'),
    '#default_value' => theme_get_setting('head_code'),
    '#description'   => t("Please enter your custom codes for &lt;head&gt; section. These codes will be inserted just before <strong>&lt;/head&gt;</strong>."),
  ];
  // Insert Codes -> Body -> Body start codes
  $form['insert_codes']['body']['insert_body_start_section'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Insert code after &lt;BODY&gt; tag'),
  ];
  $form['insert_codes']['body']['insert_body_start_section']['insert_body_start'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Enable custom codes after &lt;body&gt; tag'),
    '#default_value' => theme_get_setting('insert_body_start'),
    '#description'   => t("Check this option to enable custom codes after &lt;body&gt; tag. Uncheck to disable this feature."),
  ];
  $form['insert_codes']['body']['insert_body_start_section']['body_start_code'] = [
    '#type'          => 'textarea',
    '#title'         => t('Codes'),
    '#default_value' => theme_get_setting('body_start_code'),
    '#description'   => t("Please enter your custom codes after &lt;body&gt; tag. These codes will be inserted just after <strong>&lt;body&gt;</strong> tag."),
  ];
  // Insert Codes -> Body -> Body end codes
  $form['insert_codes']['body']['insert_body_end_section'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Insert code before &lt;/BODY&gt; tag'),
  ];
  $form['insert_codes']['body']['insert_body_end_section']['insert_body_end'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Enable custom codes before &lt;/body&gt; tag.'),
    '#default_value' => theme_get_setting('insert_body_end'),
    '#description'   => t("Check this option to enable custom codes before &lt;/body&gt; tag. Uncheck to disable this feature."),
  ];
  $form['insert_codes']['body']['insert_body_end_section']['body_end_code'] = [
    '#type'          => 'textarea',
    '#title'         => t('Codes'),
    '#default_value' => theme_get_setting('body_end_code'),
    '#description'   => t("Please enter your custom codes before &lt;/body&gt; tag. These codes will be inserted just before <strong>&lt;/body&gt;</strong>."),
  ];
  $form['insert_codes']['css']['custom'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Custom Styling'),
  ];
  $form['insert_codes']['css']['custom']['styling'] = [
    '#type'          => 'checkbox',
    '#title'         => t('Enable custom css'),
    '#default_value' => theme_get_setting('styling', 'zuvipro'),
    '#description'   => t("Check this option to enable custom styling. Uncheck to disable this fearure.<br />Please refer to this tutorial page. <a href='https://www.drupar.com/zuvipro-documentation/custom-css' target='_blank'>How To Use Custom Styling</a>"),
  ];

  $form['insert_codes']['css']['custom']['styling_code'] = [
    '#type'          => 'textarea',
    '#title'         => t('Custom CSS Codes'),
    '#default_value' => theme_get_setting('styling_code', 'zuvipro'),
    '#description'   => t('Please enter your custom css codes in this text box. You can use it to customize the appearance of your site.<br />Please refer to this tutorial for detail: <a href="https://www.drupar.com/zuvipro-documentation/custom-css" target="_blank">Custom CSS</a>'),
  ];

  /**
   * Settings under License tab.
   */
  $form['license']['info'] = [
    '#type'        => 'fieldset',
    '#title'       => t('License Type'),
    '#description' => t('<p>Your theme license is: <strong>Single Domain License</strong></p>
    <p>You are allowed to use this theme on a single website. For details, please refer to <a href="https://www.drupar.com/theme-license" target="_blank">Theme License Details</a></p>
    <hr /><br /><a href="https://www.drupar.com/upgrade/zuvipro" target="_blank">Upgrade to unlimited domain license</a>. Upgrade fee is $30 only.'),
  ];
  $form['license']['upgrade'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Upgrade'),
    '#description' => t('<p>You can upgrade to unlimited domain license. Upgrade price is $30 only.</p><p><hr /></p><p><a href="https://www.drupar.com/upgrade/zuvipro" target="_blank">Upgrade to unlimited domain license</a>.</p>'),
  ];

  /**
   * Settings under update tab.
   */
  $form['update']['update_version'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Current Theme Version'),
    '#description' => t('8.2.0'),
  ];
  $form['update']['update_info'] = [
    '#type'        => 'fieldset',
    '#title'       => t('Latest ZuviPro Version'),
    '#description' => t("<pre>$theme_update_info</pre>"),
  ];

  // Settings under support tab.
  // Settings under support tab.
  $form['support']['info'] = [
    '#type'        => 'fieldset',
    '#description' => t('<h4>Documentation</h4>
    <p>We have a detailed documentation about how to use theme. Please read the <a href="https://www.drupar.com/zuvipro-documentation" target="_blank">ZuviPro Theme Documentation</a>.</p>
    <hr />
    <h4>Open Support Ticket</h4>
    <p>If you need support that is beyond our theme documentation, please open a support ticket.<br /><a href="https://www.drupar.com/node/add/ticket" target="_blank">Create a support ticket</a></p>'),
  ];
// End form.
}
