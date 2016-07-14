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

class CtaBUttonDefaultFormatter extends FormatterBase {
   /**
   * Define how the field type is showed.
   *
   * Inside this method we can customize how the field is displayed inside
   * pages.
   */

  // public function viewElements(FieldItemListInterface $items, $langcode) {

  //   $elements = [];
  //   foreach ($items as $delta => $item) {
  //     $elements[$delta] = [
  //       '#type' => 'markup',
  //       '#markup' => $item->cta_text . ' ' . $item->cta_link
  //     ];
  //   }

  //   return $elements;
  // }

  public function viewElements(FieldItemListInterface $items, $langcode) {

    if(substr( $item->cta_link, 0, 4 ) === "node" && is_numeric(substr($item->cta_link, -1, 1))) {
      $path_alias = \Drupal::service('path.alias_manager')->getAliasByPath($item->cta_link, $langcode);
      $cta_url = $path_alias;
    }

    $elements = array();
    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        '#theme' => 'cta_button_formatter',
        '#cta_text' => $item->cta_text,
        '#cta_link' => $cta_url
      ];
    }

    return $elements;
  }
}
