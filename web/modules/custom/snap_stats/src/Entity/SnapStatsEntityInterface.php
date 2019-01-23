<?php

namespace Drupal\snap_stats\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Snap stats entity entities.
 *
 * @ingroup snap_stats
 */
interface SnapStatsEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Snap stats entity name.
   *
   * @return string
   *   Name of the Snap stats entity.
   */
  public function getName();

  /**
   * Sets the Snap stats entity name.
   *
   * @param string $name
   *   The Snap stats entity name.
   *
   * @return \Drupal\snap_stats\Entity\SnapStatsEntityInterface
   *   The called Snap stats entity entity.
   */
  public function setName($name);

  /**
   * Gets the Snap stats entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Snap stats entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Snap stats entity creation timestamp.
   *
   * @param int $timestamp
   *   The Snap stats entity creation timestamp.
   *
   * @return \Drupal\snap_stats\Entity\SnapStatsEntityInterface
   *   The called Snap stats entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Snap stats entity published status indicator.
   *
   * Unpublished Snap stats entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Snap stats entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Snap stats entity.
   *
   * @param bool $published
   *   TRUE to set this Snap stats entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\snap_stats\Entity\SnapStatsEntityInterface
   *   The called Snap stats entity entity.
   */
  public function setPublished($published);

}
