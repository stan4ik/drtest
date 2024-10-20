<?php declare(strict_types = 1);

namespace Drupal\drtest;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a drtest entity entity type.
 */
interface DrtestEntityInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
