<?php

declare(strict_types=1);

namespace Drupal\drtest\Service;

use Drupal\Core\Session\AccountInterface;

/**
 * FetcherInteface.
 */
class Fetcher implements FetcherInteface {

    /**
     * The current user.
     *
     * @var \Drupal\Core\Session\AccountInterface
     */
  protected $currentUser;

   /**
   * Constructs a Fetcher object.
   *
   * @param \Drupal\Core\Session\AccountInterface $currentUser
   *   The current user.
   */
  public function __construct(AccountInterface $currentUser) {
    $this->currentUser = $currentUser;
  }

  /**
   * Returns user label for route.
   *
   * @return string
   *   User label.
   */
  public function fetchUserByRoute(): string {
    $userName = '';

    $userName = $this->currentUser->getAccountName();

    return $userName;
  }

}