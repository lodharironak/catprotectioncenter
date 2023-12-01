<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://192.168.0.28
 * @since      1.0.0
 *
 * @package    And_everywhere_recipes
 */
/**
 * Calls the class on the post edit screen.
 */
?>
<form>
    <ul>
        <li>
            <label for="myplugin_new_field">
                <?php _e( 'Name :', 'textdomain' ); ?>
            </label>
            <input type="text" class="myplugin_new_field" name="myplugin_new_field" value="<?php echo esc_attr( $value ); ?>" />
        </li>
        <li>
        	<button class="set_custom_images button">Upload Image</button>
        </li>
        <li>
            <label for="myplugin_new_field">
                <?php _e( 'Description :', 'textdomain' ); ?>
            </label>
            <textarea></textarea>
        </li>
        <li>
            <label for="myplugin_new_field">
                <?php _e( 'Ingredients   :', 'textdomain' ); ?>
            </label>
            <textarea></textarea>
        </li>
        <li>
            <label for="myplugin_new_field">
                <?php _e( 'Instructions :', 'textdomain' ); ?>
            </label>
            <textarea></textarea>
        </li>
        <li>
            <?php require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/level_of_difficulty.php';?>
        </li> 
    </ul>
</form>
