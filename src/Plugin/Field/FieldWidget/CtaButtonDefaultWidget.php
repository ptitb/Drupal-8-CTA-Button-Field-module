<?php

namespace Drupal\cta_button\Plugin\Field\FieldWidget;

use Drupal;
use Drupal\Core\Entity\Element\EntityAutocomplete;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Plugin implementation of the 'CtaButtonDefaultWidget' widget.
 *
 * @FieldWIdget(
 *   id = "CtaButtonDefaultWidget",
 *   label = @Translation("CTA Button"),
 *   field_types = {
 *     "CtaButton"
 *   }
 * )
 */

class CtaButtonDefaultWidget extends WidgetBase {

  /**
   * Define the form for the CTA Button field type.
   *
   * Inside this method we define the form used to edit the field type.
   *
   * Here there is a list of allowed element types: https://goo.gl/XVd4tA
   */

  public function formElement(
    FieldItemListInterface $items,
    $delta,
    Array $element,
    Array &$form,
    FormStateInterface $formstate
  ) {

    // CTA Text

    $element['cta_text'] = [
      '#type' => 'textfield',
      '#title' => t('CTA Text'),
      '#default_value' => isset($items[$delta]->cta_text) ?
        $items[$delta]->cta_text : null,
      '#empty_value' => '',
      '#placeholder' => t('Call to action text'),

    ];

    // CTA Link
    // $entity = node_load($items[$delta]->cta_link);
    $entity = entity_load('node', $items[$delta]->cta_link);

    $element['cta_link'] = [
      '#type' => 'entity_autocomplete',
      '#title' => t('CTA Link'),
      '#target_type' => 'node',
      '#default_value' => isset($items[$delta]->cta_link) ?
        $entity : '',
      '#empty_value' => '',
      '#placeholder' => t('Call to action URL'),
    ];

    print '<pre>';
    // print_r($items[$delta]->cta_link);
    // print_r(entity_load('node', 1));
    // print_r($entity);
    print '</pre>';

    return $element;

  }

  /**
   * Validate the CTA Link field.
   */
  public function validate($element, FormStateInterface $form_state) {
    // $cta_link_value = $element['cta_link']['#value'];

    // if(substr( $cta_link_value, 0, 4 ) === "node" && is_numeric(substr($cta_link_value, -1, 1))) {

    // }

    // if (strlen($value) == 0) {
    //   $form_state->setValueForElement($element, '');
    //   return;
    // }
    // if (!preg_match('/^#([a-f0-9]{6})$/iD', strtolower($value))) {
    //   $form_state->setError($element, t("CTA Link m"));
    // }
  }
}
