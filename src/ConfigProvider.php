<?php

namespace Drupal\devel_mode;

use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;
use Drupal\Component\Utility\NestedArray;

/**
 * Add config provider.
 */
class ConfigProvider implements ConfigProviderInterface {

  /**
   * {@inheritdoc}
   */
  public function getConfigs($container = NULL) {
    $config = $this->getDefaultConfigs();
    if (!$container) {
      $container = \Drupal::getContainer();
    }
    try {
      $develModeConfig = $container->getParameter('devel_mode.config');
      $config = NestedArray::mergeDeep($config, $develModeConfig);
    }
    catch (ParameterNotFoundException $ex) {
      \Drupal::logger('devel_mode')->notice(t('Do not found extra configuratuion.'));
    }
    return $config;
  }

  /**
   * {@inheritdoc}
   */
  protected function getDefaultConfigs() {
    return [
      'disable_preprocess_js' => TRUE,
      'disable_preprocess_css' => FALSE,
      'modules' => [
        'devel',
        'webprofiler',
      ],
      'twig' => [
        'debug' => TRUE,
        'auto_reload' => TRUE,
        'cache' => FALSE,
      ],
      'cache.bin' => [
        'render',
      ],
    ];
  }

}
