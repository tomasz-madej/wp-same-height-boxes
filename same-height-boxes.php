<?php

/**
 * Plugin Name: Same Height Boxes
 * Plugin URI: https://github.com/tomasz-madej/wp-same-height-boxes
 * Description: This plugin sets up the same height for all boxes inside section.
 * Version: 1.0.0
 * Author: Tomasz Madej
 * Author URI: https://github.com/tomasz-madej
 * Text Domain: same-height-boxes
 * License: MIT
 */

function same_height_boxes_active_on() {

    ?>

    <div class="wrap">
        <h1 style="border-bottom: solid 1px;">
            Same Height Boxes
            <span style="float: right; font-size: 14px; font-style: italic; color: #a9a9a9;">Make it all the same!</span>
        </h1>
        <div class="examples">
            <h4>Example:</h4>
            <div class="before" style="background: #0085ba;">
                <img src="<?= plugins_url( '/assets/images/preview.jpg', __FILE__ ) ?>" alt="preview" style="display: block; height: auto; margin: 0 auto;">
            </div>
        </div>
        <div class="content" style="margin: 50px 0 0;">
            <h4><?php _e( 'Settings', 'same-height-boxes-plugin' ) ?>:</h4>
            <form action="options.php" method="post">
                <?php
                settings_fields( 'same-height-boxes-plugin-settings' );
                do_settings_sections( 'same-height-boxes-plugin-settings' );
                ?>
                <div class="input-group" style="display: block; margin-bottom: 15px;">
                    <label for="parent" style="display: block; margin-bottom: 5px;"><?php _e( '<strong>Parent</strong> container class:', 'same-height-boxes-plugin' ) ?></label>
                    <input type="text" id="parent" placeholder="some-class" name="sbh_parent" value="<?= esc_attr(get_option("sbh_parent")) ?>">
                </div>
                <div class="input-group" style="display: block; margin-bottom: 15px;">
                    <label for="child" style="display: block; margin-bottom: 5px;"><?php _e( '<strong>Single</strong> box class:', 'same-height-boxes-plugin' ) ?></label>
                    <input type="text" id="child" placeholder="some-class" name="sbh_child" value="<?= esc_attr(get_option("sbh_child")) ?>">
                </div>
                <button class="button button-primary" type="submit"><?php _e( 'Save', 'same-height-boxes-plugin' ) ?></button>
            </form>
        </div>
    </div>
    <?php
}

//JS

function same_height_boxes_scripts() {
    wp_enqueue_script( 'same-height-boxes-js', plugins_url( 'dist/js/scripts.min.js', __FILE__ ));
    wp_localize_script(
        'same-height-boxes-js',
        'sbh_var',
        array(
            'parentClass' => esc_attr(get_option("sbh_parent")),
            'childClass' => esc_attr(get_option("sbh_child")),
        )
    );
}

//CSS

function same_height_boxes_styles() {
    wp_enqueue_style( 'same-height-boxes-css', plugins_url( 'dist/css/styles.min.css', __FILE__ ));
}

//Actions

add_action('admin_menu', function() {
    add_options_page( 'Same Height Boxes Settings', 'Same Height Boxes', 'manage_options', 'same-height-boxes', 'same_height_boxes_active_on' );
});

add_action( 'admin_init', function() {
    register_setting( 'same-height-boxes-plugin-settings', 'sbh_parent' );
    register_setting( 'same-height-boxes-plugin-settings', 'sbh_child' );
});

add_action('wp_enqueue_scripts','same_height_boxes_scripts');
add_action('wp_enqueue_scripts','same_height_boxes_styles');