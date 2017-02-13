<?php

namespace Drupal\devel_mode;

use \Drupal\Core\DependencyInjection\ServiceProviderBase;
use \Drupal\Core\DependencyInjection\ContainerBuilder;
use \Symfony\Component\DependencyInjection\Definition;

/**
 * Overrides the class for the menu link tree.
 */
class DevelModeServiceProvider extends ServiceProviderBase {

  /**
   * {@inheritdoc}
   */
  public function register(ContainerBuilder $container) {
    $container->addCompilerPass(new DevelMode());
  }

}
