<?php

namespace Drupal\drtest\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\drtest\Service\Fetcher;
use Drupal\drtest\Service\FetcherInteface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'Test' block.
 *
 * @Block(
 *  id = "test_block",
 *  admin_label = @Translation("Test block"),
 * )
 */

class TestBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The user storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $storage;

  protected $fetcher;

  /**
   * Constructs an Test block object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entity_type_manager, Fetcher $fetcher) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->storage = $entity_type_manager;
    $this->fetcher = $fetcher;
  }

  /**
   * {@inheritdoc}
   */
public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): static {
    return new static($configuration, $plugin_id, $plugin_definition,
      $container->get('entity_type.manager'),
      $container->get('drtest.fetcher'),
    );
}

  /**
   * {@inheritdoc}
   */
  public function build() {

    $types = $this->storage->getStorage('node_type')->loadMultiple();

    $userName = $this->fetcher->fetchNodeByRoute();
    var_dump($userName);

    foreach($types as $type) {
        $values = [
            'status' => 1,
            'type' => $type->id(),
        ];
        $nodes = $this->storage->getStorage('node')->loadByProperties($values);

        foreach($nodes as $node) {
            $rows[] = [
                $node->id(),
                $node->title->value,
                $type->label(),
            ];
        }   
        // var_dump(nodes);
    }

    $header = [
        $this->t('nid'),
        $this->t('Title'),
        $this->t('Type'),
    ];


    return [
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
    ];
  }

  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access content');
  }

}