<?php

/**
 * @file
 * Contains \Drupal\block_page\Plugin\DisplayVariant\BlockDisplayVariant.
 */

namespace Drupal\block_page_layout\Plugin\DisplayVariant;

use Drupal\page_manager\Plugin\DisplayVariant\BlockDisplayVariant;
use Drupal\layout_plugin\Layout;

/**
 * Provides a page variant that simply contains blocks.
 *
 * @DisplayVariant(
 *   id = "block_page_layout",
 *   admin_label = @Translation("Block page (with Layout plugin integration)")
 * )
 */
class BlockPageLayoutVariant extends BlockDisplayVariant {
  /**
   * Returns instance of the layout plugin used by this page variant.
   *
   * @return \Drupal\layout_plugin\Plugin\Layout\LayoutInterface
   *   Layout plugin instance.
   */
  public function getLayout() {
    if (!isset($this->layout)) {
      $this->layout = Layout::layoutPluginManager()->createInstance($this->configuration['layout'], array());
    }
    return $this->layout;
  }

  /**
   * {@inheritdoc}
   */
  public function getRegionNames() {
    return $this->getLayout()->getRegionNames();
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, array &$form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);

    // Do not allow blocks to be added until the page variant has been saved.
    if (!$this->id()) {
      $form['layout'] = array(
        '#title' => $this->t('Layout'),
        '#type' => 'select',
        '#options' => Layout::getLayoutOptions(array('group_by_category' => TRUE)),
        '#default_value' => NULL
      );
      return $form;
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, array &$form_state) {
    parent::submitConfigurationForm($form, $form_state);

    if (isset($form_state['values']['layout'])) {
      $this->configuration['layout'] = $form_state['values']['layout'];
    }

  }
}
