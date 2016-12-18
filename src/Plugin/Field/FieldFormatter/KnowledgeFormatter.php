<?php

/**
 * @file
 * Contains \Drupal\knowledge\Plugin\Field\FieldFormatter\KnowledgeFormatter.
 */

namespace Drupal\knowledge\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'knowledge_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "knowledge_formatter",
 *   module = "knowledge",
 *   label = @Translation("Knowledge"),
 *   field_types = {
 *     "knowledge"
 *   }
 * )
 */
class KnowledgeFormatter extends FormatterBase {
    /**
     * {@inheritdoc}
     */
    public static function defaultSettings() {
        return array(
            // Implement default settings.
        ) + parent::defaultSettings();
    }

    /**
     * {@inheritdoc}
     */
    public function settingsForm(array $form, FormStateInterface $form_state) {
        return array(
            // Implement settings form.
        ) + parent::settingsForm($form, $form_state);
    }

    /**
     * {@inheritdoc}
     */
    public function settingsSummary() {
        $summary = [];
        // Implement settings summary.

        return $summary;
    }

    /**
     * {@inheritdoc}
     */
    public function viewElements(FieldItemListInterface $items, $langcode) {
        $elements = [];

        foreach ($items as $delta => $item) {
            $elements[$delta] = ['#markup' => $this->viewValue($item)];
        }
        return $elements;
    }

    /**
     * Generate the output appropriate for one field item.
     *
     * @param \Drupal\Core\Field\FieldItemInterface $item
     *   One field item.
     *
     * @return array
     *   The textual output generated as a render array.
     */
    protected function viewValue(FieldItemInterface $item) {
        // The text value has no text format assigned to it, so the user input
        // should equal the output, including newlines.
        return [
            '#type' => 'inline_template',
            '#template' => '{{ value|nl2br }}',
            '#context' => ['value' => $item->value],
        ];
    }

}
