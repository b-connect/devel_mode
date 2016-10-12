<?php

namespace Drupal\devel_mode;

use \Drupal\Core\DependencyInjection\ServiceProviderBase;
use \Drupal\Core\DependencyInjection\ContainerBuilder;
use \Symfony\Component\DependencyInjection\Definition;
use \Drupal\Core\Config;
use \Symfony\Component\DependencyInjection\Parameter;
use \Drupal\devel_mode\DevelModeBinNull;



/**
 * Overrides the class for the menu link tree.
 */
class DevelModeServiceProvider extends ServiceProviderBase {

  /**
   * {@inheritdoc}
   */
  public function alter(ContainerBuilder $container) {
    $twig = $container->getParameter('twig.config');
    $twig['debug'] = true;
    $twig['auto_reload'] = true;
    $twig['cache'] = false;

    $container->setParameter('twig.config',$twig);

    $renderer = $container->getParameter('renderer.config');
    $renderer['auto_placeholder_conditions']['max-age'] = -1;
    $container->setParameter('renderer.config', $renderer);

    $container->setParameter('http.response.debug_cacheability_headers', true);
  }

  public function register(ContainerBuilder $container) {
    $container->addCompilerPass(new DevelModeBinNull());
  }

}
