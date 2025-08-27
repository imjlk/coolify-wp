<?php
/**
 * Plugin Name: Custom Blocks
 * Description: Custom Gutenberg blocks for your WordPress site
 * Version: 1.0.0
 * Author: Your Name
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('CUSTOM_BLOCKS_PLUGIN_URL', plugin_dir_url(__FILE__));
define('CUSTOM_BLOCKS_PLUGIN_PATH', plugin_dir_path(__FILE__));

// Initialize plugin
class CustomBlocks {
    
    public function __construct() {
        add_action('init', array($this, 'init'));
        add_action('enqueue_block_editor_assets', array($this, 'enqueue_block_editor_assets'));
        add_action('enqueue_block_assets', array($this, 'enqueue_block_assets'));
    }
    
    public function init() {
        // Register blocks
        $this->register_blocks();
    }
    
    public function register_blocks() {
        // Register each block
        register_block_type(CUSTOM_BLOCKS_PLUGIN_PATH . 'build/hero-block');
        register_block_type(CUSTOM_BLOCKS_PLUGIN_PATH . 'build/card-block');
    }
    
    public function enqueue_block_editor_assets() {
        wp_enqueue_script(
            'custom-blocks-editor',
            CUSTOM_BLOCKS_PLUGIN_URL . 'build/index.js',
            array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components'),
            filemtime(CUSTOM_BLOCKS_PLUGIN_PATH . 'build/index.js')
        );
        
        wp_enqueue_style(
            'custom-blocks-editor',
            CUSTOM_BLOCKS_PLUGIN_URL . 'build/index.css',
            array(),
            filemtime(CUSTOM_BLOCKS_PLUGIN_PATH . 'build/index.css')
        );
    }
    
    public function enqueue_block_assets() {
        wp_enqueue_style(
            'custom-blocks-style',
            CUSTOM_BLOCKS_PLUGIN_URL . 'build/style-index.css',
            array(),
            filemtime(CUSTOM_BLOCKS_PLUGIN_PATH . 'build/style-index.css')
        );
    }
}

new CustomBlocks();