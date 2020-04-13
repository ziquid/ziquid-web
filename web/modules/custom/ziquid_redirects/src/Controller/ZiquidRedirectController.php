<?php

namespace Drupal\ziquid_redirects\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Controller for custom ziquid URL redirects.
 */
class ZiquidRedirectController extends ControllerBase {

  /**
   * Redirect for Zoom.
   */
  public function zoomRedirect() {
    $response = new RedirectResponse('https://zoom.us/j/2110111973', 301);
    $response->send();
  }

  /**
   * Redirect for Youtube.
   */
  public function youtubeRedirect() {
    $response = new RedirectResponse('https://www.youtube.com/channel/UCHok9pO-Jv2f-aTnG87k87w/featured', 302);
    $response->send();
  }

  /**
   * Redirect for PhpMyAdmin.
   */
  public function pmaRedirect() {
    $response = new RedirectResponse('http://ziquid.com/phpmyadmin', 301);
    $response->send();
  }

  /**
   * Redirect for iOS beta.
   */
  public function iosBetaRedirect() {
    $response = new RedirectResponse('https://testflight.apple.com/join/vi0q9Ffy', 301);
    $response->send();
  }

  /**
   * Redirect for Trello.
   */
  public function trelloRedirect() {
    $response = new RedirectResponse('https://trello.com/b/iuGEXINc/tasks', 302);
    $response->send();
  }
}
