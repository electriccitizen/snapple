<?php

namespace Drupal\snap_stats\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Snap stats entity entities.
 */
class SnapStatsEntityViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
