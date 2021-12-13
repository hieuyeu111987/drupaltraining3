<?php
namespace Drupal\rsvplist\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;

class ExampleRegister extends FormBase {
  
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Họ tên'),
      '#required' => true,
    );

    $form['phone'] = array(
      '#type' => 'tel',
      '#title' => t('Số điện thoại'),
      '#required' => true,
    );

    $form['email'] = array(
      '#type' => 'email',
      '#title' => t('E-mail'),
    );
    
    $form['old'] = array(
      '#type' => 'select',
      '#title' => t('Độ tuổi'),
      '#options' => [
        '10-20' => [
          '10-17' => '10-17',
          '18-20' => '18-20',
        ],
        '20-30' => '20-30',
        '30-50' => '30-50',
      ]
    );

    $form['description'] = array(
      '#type' => 'textarea',
      '#title' => t('Mô tả bản thân'),
    );

    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Send'),
    );
    return $form;
  }
  
  public function getFormId() {
    return 'custom_contact_form';
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $email = $form_state->getValue('email');
    if (strpos($email, '@kyanon.digital') == "") {
      $form_state->setErrorByName('email', $this->t('Email không thuốc @kyanon.digital!'));
    }
    $phone = $form_state->getValue('phone');
    if (!is_numeric($phone) || strlen($phone) != 10) {
      $form_state->setErrorByName('phone', $this->t('Số điện thoại không đúng!'));
    }
    $old = $form_state->getValue('old');
    if ($old == '10-17') {
      $form_state->setErrorByName('old', $this->t('Bạn chưa đủ tuổi!'));
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    
    // $name = $form_state->getValue('name');
    // $email = $form_state->getValue('email');
    // $phone = $form_state->getValue('phone');
    // $old = $form_state->getValue('old');
    // $description = $form_state->getValue('description');

    //create a table drupaltest
    // db_insert('drupaltest')
    //   ->fields(array(
    //     'Name' => $name,
    //     'Phone' => $phone,
    //     'Email' => $email,
    //     'Old' => $old,
    //     'Description' => $description
    //   ))
    //   ->execute();

    // drupal_set_message(t('Success'));
    $this->messenger()->addStatus($this->t('Success'));
    $form_state->setRedirect('<front>');
    
  }
}