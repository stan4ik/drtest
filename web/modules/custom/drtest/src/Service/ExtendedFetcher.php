<?php

declare(strict_types=1);

namespace Drupal\drtest\Service;

use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * FetcherInteface.
 */
class ExtendedFetcher extends Fetcher {

  /**
   * Returns user label for route.
   *
   * @return string
   *   User label.
   */
  public function fetchNodeByRoute(): string {
    $nodeName = '';
    $node = \Drupal::routeMatch()->getParameter('node');

    if(isset($node)) {
        $nodeName = $node->getTrimmedTitle();
    }

    return $nodeName;
  }

}