<?php

namespace Drupal\cta_button\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\Field\FieldStorageDefinitionInterface as StorageDefinition;

/**
 * Plugin implementation of the 'cta_button' field type.
 *
 * @FieldType(
 *   id = " CtaButton",
 *   label = @Translation("CTA Button"),
 *   description = @Translation("Stores an Call To Action Button"),
 *   category = @Translation("Custom"),
 *   default_widget = "CtaButtonDefaultWidget",
 *   default_formatter = "CtaButtonDefaultFormatter"
 * )
 */

class CtaButton extends FieldItemBase {

  /**
   * Field type properties definition.
   *
   * Inside this method we define all the fields (properties) that our
   * custom field type will have.
   *
   * Here there is a list of allowed property types: https://goo.gl/sIBBgO
   */

  public static function propertyDefinitions(StorageDefinition $storage) {

    $properties = [];

    $properties['cta_text'] = DataDefinition::create('string')
      ->setLabel(t('CTA text'));

    $properties['cta_link'] = DataDefinition::create('string')
      ->setLabel(t('CTA Link'));

    return $properties;
  }


  /**
   * Field type schema definition.
   *
   * Inside this method we defines the database schema used to store data for
   * our field type.
   *
   * Here there is a list of allowed column types: https://goo.gl/YY3G7s
   */

  public static function schema(StorageDefinition $storage) {

    $columns = [];

    $columns['cta_text'] = [
      'type' => 'char',
      'length' => 255,
    ];
    $columns['cta_link'] = [
      'type' => 'char',
      'length' => 255,
    ];

    return [
      'columns' => $columns,
      'indexes' => [],
    ];
  }

  /**
   * Define when the field is empty.
   *
   * This method is important and used internally by Drupal. Take a moment
   * to define when the field fype must be considered empty.
   */

  public function isEmpty() {

    $isEmpty =
      empty($this->get('cta_text')->getValue()) &&
      empty($this->get('cta_link')->getValue());

    return $isEmpty;
  }

}
