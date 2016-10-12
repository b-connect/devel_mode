<?php

namespace Drupal\devel_mode;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Config\ConfigFactoryOverrideInterface;

/**
 * Class ConfigOverride.
 *
 * @package Drupal\devel_mode
 */
class ConfigOverride implements ConfigFactoryOverrideInterface, ConfigOverrideInterface {

  /**
   * {@inheritdoc}
   */
  public function loadOverrides($names) {
    $overrides = array();
    if (in_array('system.performance', $names)) {
      $overrides['system.performance'] = [
        'css' => ['preprocess' => TRUE],
        'js'  => ['preprocess' => TRUE],
      ];
    }
    return $overrides;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheSuffix() {
    return 'DevelMode';
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheableMetadata($name) {
    return new CacheableMetadata();
  }

  /**
 * {@inheritdoc}
 */
  public function createConfigObject($name, $collection = StorageInterface::DEFAULT_COLLECTION) {
    return NULL;
  }

}
