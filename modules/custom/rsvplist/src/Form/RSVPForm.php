<?php
/**
  * @file
  * Contains\Drupal\rsvplist\Form\RSVPForm
  */
namespace Drupal\rsvplist\Form;

use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
  * Provides an RSVP Email form.
  */
class RSVPForm extends FormBase {
    /**
      * (@inheritdoc)
      */
    public function getFormId() {
      return 'rsvplist_email_form';
    }

    /**
      * (@inheritdoc)
      */
    public function buildForm(array $form, FormStateInterface $form_state) {
      $node = \Drupal::routeMatch()->getParameter('node');
      $nid = $node->nid->value;
      $form['email'] = array(
        '#title' => t('Email Address'),
        '#type' => 'textfield',
        '#size' => 25,
        '#description' => t("We'll send updates to the email address your provide."),
        '#required' => TRUE,
      );
      $form['submit'] = array(
        '#type' => 'submit',
        '#value' => t('RSVP'),
      );
      $form['nid'] = array(
        '#type' => 'hidden',
        '#value' => $nid,
      );
      return $form;
    }

    public function validateForm(array &$form, FormStateInterface $form_state) {
      
    }

    /**
      * (@inheritdoc)
      */
    public function submitForm(array &$form, FormStateInterface $form_state) {
      $this->messenger()->addStatus($this->t('The form is working'));
    }
}