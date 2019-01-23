<?php
/**
 * @file
 * Example of how to write a Migrate API process plugin.
 */

// Process plugins live in the Drupal\{MODULE}\Plugin\migrate\process
// namespace.
namespace Drupal\snap_import\Plugin\migrate\process;

use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\MigrateException;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\Row;

/**
 * This plugin parses complex WP categories
 *
 * @MigrateProcessPlugin(
 *   id = "map_author"
 * )
 */
class MapAuthor extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    // In the transform() method we perform whatever operations our process
    // plugin is going to do in order to transform the $value provided into its
    // desired form, and then return that value.


    if (is_string($value)) {
        $db = \Drupal\Core\Database\Database::getConnection();
        $query = $db->select('users', 'u');
        $query->join('user__field_gaid', 'g', 'g.entity_id = u.uid');

        $result = $query
            ->fields('u', ['uid'])
            ->condition('g.field_gaid_value', $value, "=")
            ->execute();



        $value = $result->fetchField(0);
        drush_print($value);
      return $value;

    }
    else {
      // Throw an exception indicating our process plugin failed to transform
      // this value.
      throw new MigrateException(sprintf('%s is not a string', var_export($value, TRUE)));
    }
  }
}