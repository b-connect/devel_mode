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
  public function alter(ContainerBuilder $container) {
    $twig = $container->getParameter('twig.config');

    $container->setParameter('twig.config', $twig);

    $renderer = $container->getParameter('renderer.config');
    $renderer['auto_placeholder_conditions']['max-age'] = -1;
    $container->setParameter('renderer.config', $renderer);

    $container->setParameter('http.response.debug_cacheability_headers', TRUE);
  }

  /**
   * {@inheritdoc}
   */
  public function register(ContainerBuilder $container) {
    $container->addCompilerPass(new DevelModeBinNull());
  }

}
