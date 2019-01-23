<?php

/**
 * @file
 * Contains snap_stats_entity.page.inc.
 *
 * Page callback for Snap stats entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Snap stats entity templates.
 *
 * Default template: snap_stats_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_snap_stats_entity(array &$variables) {
  // Fetch SnapStatsEntity Entity Object.
  $snap_stats_entity = $variables['elements']['#snap_stats_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
