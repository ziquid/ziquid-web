<?php

namespace Drupal\ziquid\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;


class ZiquidController {

  public function zoomRedirect() {
    $response = new RedirectResponse('https://zoom.us/2110111973', 301);
    $response->send();
    return;
  }
}
