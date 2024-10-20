<?php

namespace Drupal\drtest\Entity;

use Drupal\node\Entity\Node;
use Drupal\node\NodeInterface;

class DrtestNode extends Node implements NodeInterface {

    function getTrimmedTitle() {
        return substr($this->label(), 0, 10);
    }
}