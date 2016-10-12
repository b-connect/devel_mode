<?php

namespace Drupal\devel_mode;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Adds cache_bins parameter to the container.
 */
class DevelModeBinNull implements CompilerPassInterface {

  /**
   * Implements CompilerPassInterface::process().
   *
   * Collects the cache bins into the cache_bins parameter.
   */
  public function process(ContainerBuilder $container) {
    $defaults = $container->getParameter('cache_default_bin_backends');
    $defaults['render'] = 'cache.backend.devel_mode_null';
    $defaults['menu'] = 'cache.backend.devel_mode_null';
    $defaults['dynamic_page_cache']  = 'cache.backend.devel_mode_null';
    $container->setParameter('system.logging','verbose');
    $container->setParameter('cache_default_bin_backends', $defaults);
  }

}
