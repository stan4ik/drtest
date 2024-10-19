<?php

declare(strict_types=1);

namespace Drupal\drtest\Service;

/**
 * FetcherInteface.
 */
interface FetcherInteface {


  /**
   * Returns user label for route.
   *
   * @return string
   *   User label.
   */
  public function fetchUserByRoute(): string;

}
