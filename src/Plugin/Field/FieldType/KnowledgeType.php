<?php

/**
 * @file
 * Contains \Drupal\knowledge\Plugin\Field\FieldType\KnowledgeType.
 */

namespace Drupal\knowledge\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'knowledge_type' field type.
 *
 * @FieldType(
 *   id = "knowledge",
 *   label = @Translation("Knowledge type"),
 *   description = @Translation("Knowledge field "),
 *   category = @Translation("Custom"),
 *   default_widget = "knowledge_widget",
 *   default_formatter = "knowledge_formatter"
 * )
 */
class KnowledgeType extends FieldItemBase {
    /**
     * {@inheritdoc}
     */
    public static function defaultStorageSettings() {
        return array(
            'max_length' => 255,
            'is_ascii' => FALSE,
            'case_sensitive' => FALSE,
        ) + parent::defaultStorageSettings();
    }

    /**
     * {@inheritdoc}
     */
    public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
        // Prevent early t() calls by using the TranslatableMarkup.
        $properties['value'] = DataDefinition::create('string')
            ->setLabel(t('Knowledge'));

        return $properties;
    }

    /**
     * {@inheritdoc}
     */
    public static function schema(FieldStorageDefinitionInterface $field_definition) {

        return array(
            'columns' => array(
                'value' => array(
                    'type' => 'varchar',
                    'length' => 256,
                    'not null' => TRUE,
                ),
            ),
        );

    }


    /**
     * {@inheritdoc}
     */
    public function isEmpty() {
        $value = $this->get('value')->getValue();
        return $value === NULL || $value === '';
    }



}
