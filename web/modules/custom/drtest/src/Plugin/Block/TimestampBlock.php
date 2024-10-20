<?php

namespace Drupal\drtest\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\UncacheableDependencyTrait;


/**
 * Provides a 'Timestamp' block.
 *
 * @Block(
 *  id = "timestamp_block",
 *  admin_label = @Translation("Timestamp block"),
 * )
 */

class TimestampBlock extends BlockBase {

  use UncacheableDependencyTrait;

  /**
   * {@inheritdoc}
   */
  public function build() {

    $time_value = \Drupal::time()->getCurrentTime();

    if($time_value % 2 == 0) {
      $s = 'even';
    }
    else {
      $s = 'odd';
    }

    return [
      '#markup' => sprintf('Server time contains an %s number', $s),
    ];
  }
  
}