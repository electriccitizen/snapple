<?php

namespace Drupal\snap_stats;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Snap stats entity entity.
 *
 * @see \Drupal\snap_stats\Entity\SnapStatsEntity.
 */
class SnapStatsEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\snap_stats\Entity\SnapStatsEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished snap stats entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published snap stats entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit snap stats entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete snap stats entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add snap stats entity entities');
  }

}
