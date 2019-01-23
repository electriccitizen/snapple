<?php

namespace Drupal\snap_stats\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Snap stats entity entity.
 *
 * @ingroup snap_stats
 *
 * @ContentEntityType(
 *   id = "snap_stats_entity",
 *   label = @Translation("Snap stats entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\snap_stats\SnapStatsEntityListBuilder",
 *     "views_data" = "Drupal\snap_stats\Entity\SnapStatsEntityViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\snap_stats\Form\SnapStatsEntityForm",
 *       "add" = "Drupal\snap_stats\Form\SnapStatsEntityForm",
 *       "edit" = "Drupal\snap_stats\Form\SnapStatsEntityForm",
 *       "delete" = "Drupal\snap_stats\Form\SnapStatsEntityDeleteForm",
 *     },
 *     "access" = "Drupal\snap_stats\SnapStatsEntityAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\snap_stats\SnapStatsEntityHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "snap_stats_entity",
 *   admin_permission = "administer snap stats entity entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/snap_stats_entity/{snap_stats_entity}",
 *     "add-form" = "/admin/structure/snap_stats_entity/add",
 *     "edit-form" = "/admin/structure/snap_stats_entity/{snap_stats_entity}/edit",
 *     "delete-form" = "/admin/structure/snap_stats_entity/{snap_stats_entity}/delete",
 *     "collection" = "/admin/structure/snap_stats_entity",
 *   },
 *   field_ui_base_route = "snap_stats_entity.settings"
 * )
 */
class SnapStatsEntity extends ContentEntityBase implements SnapStatsEntityInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return (bool) $this->getEntityKey('status');
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($published) {
    $this->set('status', $published ? TRUE : FALSE);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Snap stats entity entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Snap stats entity entity.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Snap stats entity is published.'))
      ->setDefaultValue(TRUE)
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => -3,
      ]);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    $fields['snap_data_seconds'] = BaseFieldDefinition::create('integer')
          ->setLabel(t('Seconds'))
          ->setDescription(t('Time in seconds'))
          ->setRevisionable(TRUE)
          ->setTranslatable(TRUE)
          ->setDisplayOptions('form', array(
              'type' => 'string_textfield',
              'settings' => array(
                  'display_label' => TRUE,
              ),
          ))
          ->setDisplayOptions('view', array(
              'label' => 'hidden',
              'type' => 'string',
          ))
          ->setDisplayConfigurable('form', TRUE)
          ->setRequired(TRUE);

      $fields['snap_data_uid'] = BaseFieldDefinition::create('string')
          ->setLabel(t('User ID'))
          ->setDescription(t('User ID tracker from Google Analytics'))
          ->setRevisionable(TRUE)
          ->setTranslatable(TRUE)
          ->setDisplayOptions('form', array(
              'type' => 'string_textfield',
              'settings' => array(
                  'display_label' => TRUE,
              ),
          ))
          ->setDisplayOptions('view', array(
              'label' => 'hidden',
              'type' => 'string',
          ))
          ->setDisplayConfigurable('form', TRUE)
          ->setRequired(TRUE);

       $fields['snap_data_category'] = BaseFieldDefinition::create('string')
          ->setLabel(t('Category'))
          ->setDescription(t('Activity tracker by category'))
          ->setRevisionable(TRUE)
          ->setTranslatable(TRUE)
          ->setDisplayOptions('form', array(
              'type' => 'string_textfield',
              'settings' => array(
                  'display_label' => TRUE,
              ),
          ))
          ->setDisplayOptions('view', array(
              'label' => 'hidden',
              'type' => 'string',
          ))
          ->setDisplayConfigurable('form', TRUE)
          ->setRequired(TRUE);

    return $fields;
  }

}
