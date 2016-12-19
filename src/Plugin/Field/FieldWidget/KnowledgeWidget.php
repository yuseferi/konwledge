<?php

/**
 * @file
 * Contains \Drupal\knowledge\Plugin\Field\FieldWidget\KnowledgeWidget.
 */

namespace Drupal\knowledge\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'knowledge_widget' widget.
 *
 * @FieldWidget(
 *   id = "knowledge_widget",
 *   label = @Translation("Knowledge widget"),
 *   field_types = {
 *     "knowledge"
 *   }
 * )
 */
class KnowledgeWidget extends WidgetBase {
    /**
     * {@inheritdoc}
     */
    public static function defaultSettings() {
        return array(
            'size' => 60,
            'placeholder' => '',
        ) + parent::defaultSettings();
    }

    /**
     * {@inheritdoc}
     */
    public function settingsForm(array $form, FormStateInterface $form_state) {
        $elements = [];

        $elements['size'] = array(
            '#type' => 'number',
            '#title' => t('Size of textfield'),
            '#default_value' => $this->getSetting('size'),
            '#required' => TRUE,
            '#min' => 1,
        );
        $elements['placeholder'] = array(
            '#type' => 'textfield',
            '#title' => t('Placeholder'),
            '#default_value' => $this->getSetting('placeholder'),
            '#description' => t('Text that will be shown inside the field until a value is entered. This hint is usually a sample value or a brief description of the expected format.'),
        );

        return $elements;
    }

    /**
     * {@inheritdoc}
     */
    public function settingsSummary() {
        $summary = [];

        $summary[] = t('Textfield size: !size', array('!size' => $this->getSetting('size')));
        if (!empty($this->getSetting('placeholder'))) {
            $summary[] = t('Placeholder: @placeholder', array('@placeholder' => $this->getSetting('placeholder')));
        }

        return $summary;
    }

    /**
     * {@inheritdoc}
     */
    public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
        $element['value'] = $element + array(
            '#type' => 'textfield',
            '#autocomplete_route_name' => 'knowledge.gettitle',
            '#autocomplete_route_parameters' =>array('lang' => 'en'),
            '#title' => 'Knowledge Item',
            '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : NULL,
            '#size' => $this->getSetting('size'),
            '#placeholder' => $this->getSetting('placeholder'),
            '#maxlength' => $this->getFieldSetting('max_length'),
            '#element_validate' => ['knowledge_field_result_validate'],
            '#executes_submit_callback' => ['knowledge_field_result_submit']
        );
        return $element;
    }

}
