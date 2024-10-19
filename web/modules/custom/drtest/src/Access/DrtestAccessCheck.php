<?php

namespace Drupal\drtest\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Determines access to user page.
 */
class DrtestAccessCheck implements AccessInterface {

  /**
   * Checks access to the user page.
   */
  public function access(RouteMatchInterface $route_match, AccountInterface $account) {

    $user = $route_match->getParameter('user');

    if($user) {
        if ($user->hasField('field_privacy')) {
            $privacy = $user->get('field_privacy')->value;

            if($privacy == '1') {
                return AccessResult::forbidden();
            }
        }
        
    }

    return AccessResult::allowed();
  }

}