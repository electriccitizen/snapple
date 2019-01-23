<?php

/**
 * @file
 * Contains snap_stats\snap_stats.views.inc..
 * Provide a custom views field data that isn't tied to any other module. */

use Drupal\Component\Utility\NestedArray;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Render\Markup;
use Drupal\field\FieldConfigInterface;
use Drupal\field\FieldStorageConfigInterface;
use Drupal\system\ActionConfigEntityInterface;

/**
* Implements hook_views_data().
*/
function snap_stats_views_data() {

    $data['views']['table']['group'] = t('Custom Global');
    $data['views']['table']['join'] = [
      // #global is a special flag which allows a table to appear all the time.
      '#global' => [],
    ];


    $data['views']['total_time_on_site'] = [
        'title' => t('Total time on site'),
        'help' => t('Aggregrate the total amount of time spent on site by user'),
        'field' => [
            'id' => 'total_time_on_site',
        ],
    ];

    return $data;
}
