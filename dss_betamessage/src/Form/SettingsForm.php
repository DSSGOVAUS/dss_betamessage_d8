<?php

/**
*	DSS Beta Message Configuration form
*/

namespace Drupal\dss_betamessage\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SettingsForm extends ConfigFormBase {

  // Return Form ID
  public function getFormId() {
    return 'dss_betamessage_settings_form';
  }

  // Return array of settings that can be modified
  protected function getEditableConfigNames() {
    return array('dss_betamessage.credentials');
  }

  // Build the form
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Get the defaults from the config file
    $config = $this->config('dss_betamessage.credentials');

		$form['messagewords'] = array(
			'#type' => 'textarea',
			'#title' => t('Beta message words'),
			'#default_value' => $config->get('messagewords'),
      '#rows' => 4,
      '#cols' => 60,
		);
		$form['attach_to'] = array(
			'#type' => 'textfield',
			'#title' => t('Selector for element to attach beta tag to'),
			'#default_value' => $config->get('attach_to'),
			'#size' => 32,
			'#maxlength' => 32,
		);
		return parent::buildForm($form, $form_state);
	}

  // Save new values on Form Submit
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('dss_betamessage.credentials')
		->set('messagewords', $form_state->getValue(array('messagewords')))
		->set('attach_to', $form_state->getValue(array('attach_to')))
    ->save();
    parent::submitForm($form, $form_state);
  }

}
