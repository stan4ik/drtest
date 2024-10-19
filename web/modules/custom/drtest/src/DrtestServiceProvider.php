<?php

namespace Drupal\drtest;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Modifies the language manager service.
 */
class DrtestServiceProvider extends ServiceProviderBase {

  /**
   * {@inheritdoc}
   */
  public function alter(ContainerBuilder $container) {
    if ($container->hasDefinition('drtest.fetcher')) {
      $definition = $container->getDefinition('drtest.fetcher');
      $definition->setClass('Drupal\drtest\Service\ExtendedFetcher');
      $definition->addArgument(new Reference('current_user'));
    }
  }

}