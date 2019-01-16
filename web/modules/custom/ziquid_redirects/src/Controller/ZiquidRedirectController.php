<?php

/**
 * @file
 * Contains \Drupal\ziquid_redirects\Controller\ZiquidRedirectController.
 */
namespace Drupal\ziquid_redirects\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;

/*
 * Controller for custom ziquid URL redirects.
 */
class ZiquidRedirectController extends ControllerBase {
  public function zoomRedirect() {
    $response = new RedirectResponse('https://zoom.us/j/2110111973', 301);
    $response->send();
    return;
  }

  public function iosBetaRedirect() {
    $response = new RedirectResponse('https://testflight.apple.com/join/vi0q9Ffy', 301);
    $response->send();
    return;
  }
}
