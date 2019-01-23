<?php

namespace Drupal\snap_stats\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Snap stats entity edit forms.
 *
 * @ingroup snap_stats
 */
class SnapStatsEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\snap_stats\Entity\SnapStatsEntity */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Snap stats entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Snap stats entity.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.snap_stats_entity.canonical', ['snap_stats_entity' => $entity->id()]);
  }

}
