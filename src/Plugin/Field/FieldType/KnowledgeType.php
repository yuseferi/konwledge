<?php

/**
 * @file
 * Contains \Drupal\knowledge\Plugin\Field\FieldType\KnowledgeType.
 */

namespace Drupal\knowledge\Plugin\Field\FieldType;

use Drupal\Component\Utility\Random;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'knowledge_type' field type.
 *
 * @FieldType(
 *   id = "knowledge_type",
 *   label = @Translation("Knowledge type"),
 *   description = @Translation("This is Knowledge type description"),
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
        $properties['knowledge'] = DataDefinition::create('string')
            ->setLabel(new TranslatableMarkup('Knowledge'));

        return $properties;
    }

    /**
     * {@inheritdoc}
     */
    public static function schema(FieldStorageDefinitionInterface $field_definition) {
        $schema = array(
            'columns' => array(
                'knowledge' => array(
                    'description' => 'Knowledge .',
                    'type' => 'varchar',
                    'length' => '255',
                    'not null' => TRUE,
                    'default' => '',
                ),
            ),
        );

        return $schema;
    }


    /**
     * {@inheritdoc}
     */
    public function isEmpty() {
        $value = $this->get('knowledge')->getValue();
        return $value === NULL || $value === '';
    }

}
