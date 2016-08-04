<?php

namespace Drupal\cta_button\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal;

/**
 * Plugin implementation of the 'CtaButtonDefaultFormatter' formatter.
 *
 * @FieldFormatter(
 *   id = "CtaButtonDefaultFormatter",
 *   label = @Translation("CTA Button"),
 *   field_types = {
 *     "CtaButton"
 *   }
 * )
 */

class CtaButtonDefaultFormatter extends FormatterBase {
   /**
   * Define how the CTA Button field type is showed.
   *
   * Inside this method we can customize how the field is displayed inside
   * pages.
   */

  public function viewElements(FieldItemListInterface $items, $langcode) {

  // // Don't use a template file but create render array directly
  //   $elements = [];
  //   foreach ($items as $delta => $item) {
  //     $elements[$delta] = [
  //       '#type' => 'markup',
  //       '#markup' => $item->cta_text . ' ' . $item->cta_link
  //     ];
  //   }

    // Use template
    $elements = array();
    foreach ($items as $delta => $item) {

      if($path_alias = \Drupal::service('path.alias_manager')->getAliasByPath('/node/' . $item->cta_link, $langcode)) {
        $cta_url = $GLOBALS['base_url'] . $path_alias;
      } else {
        $cta_url = $GLOBALS['base_url'] . '/node/' . $item->cta_link;
      }

      $elements[$delta] = [
        '#theme' => 'cta_button_formatter',
        '#cta_text' => $item->cta_text,
        '#cta_link' => $cta_url
      ];
    }

    // var_dump(\Drupal::service('path.alias_manager')->getAliasByPath('/node/' . $item->cta_link));


    return $elements;
  }
}
