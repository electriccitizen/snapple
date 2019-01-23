<?php

namespace Drupal\snap_stats;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Snap stats entity entities.
 *
 * @ingroup snap_stats
 */
class SnapStatsEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Snap stats entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\snap_stats\Entity\SnapStatsEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.snap_stats_entity.edit_form',
      ['snap_stats_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
