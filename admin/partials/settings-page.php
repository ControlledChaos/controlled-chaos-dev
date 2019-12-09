<?php
/**
 * Settings page output.
 *
 * @package    Controlled_Chaos_Development
 * @subpackage Admin\Partials
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace CC_Dev\Admin\Partials;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Active tab switcher.
 *
 * @since  1.0.0
 * @return void
 */
if ( isset( $_GET[ 'tab' ] ) ) {
    $active_tab = $_GET[ 'tab' ];
} else {
    $active_tab = 'general';
}

/**
 * Set up the page tabs as an array for adding tabs
 * from another plugin or from a theme.
 *
 * @since  1.0.0
 * @return array
 */
$tabs = [

    // General options tab.
    sprintf(
        '<a href="?page=%1s-scripts&tab=general" class="nav-tab %2s"><span class="dashicons dashicons-admin-tools"></span> %3s</a>',
        CCDEV_ADMIN_SLUG,
        $active_tab == 'general' ? 'nav-tab-active' : '',
        esc_html__( 'General', 'controlled-chaos-dev' )
    ),

    // Vendor options tab.
    sprintf(
        '<a href="?page=%1s-scripts&tab=frontend" class="nav-tab %2s"><span class="dashicons dashicons-admin-appearance"></span> %3s</a>',
        CCDEV_ADMIN_SLUG,
        $active_tab == 'frontend' ? 'nav-tab-active' : '',
        esc_html__( 'Frontend', 'controlled-chaos-dev' )
    )

];

// Apply a filter to the tabs array for adding tabs.
$page_tabs = apply_filters( 'ccdev_tabs_script_options', $tabs );

/**
 * Do settings section and fields by tab.
 *
 * @since  1.0.0
 * @return void
 */
if ( 'general' == $active_tab ) {
    $section = 'ccdev-settings-general';
    $fields  = 'ccdev-settings-general';
} elseif ( 'frontend' == $active_tab ) {
    $section = 'ccdev-settings-frontend';
    $fields  = 'ccdev-settings-frontend';
} else {
    $section = null;
    $fields  = null;
}

// Apply filters to the sections and fields for new tabs.
$do_section = apply_filters( 'ccdev_section_script_options', $section );
$do_fields  = apply_filters( 'ccdev_fields_script_options', $fields );


/**
 * Conditional save button text by tab.
 *
 * @since  1.0.0
 * @return string Returns the button label.
 */
if ( 'general' == $active_tab  ) {
    $save = __( 'Save General', 'controlled-chaos-dev' );
} elseif ( 'frontend' == $active_tab ) {
    $save = __( 'Save Frontend', 'controlled-chaos-dev' );
} else {
    $save = __( 'Save Settings', 'controlled-chaos-dev' );
}

// Apply a filter for new tabs added by another plugin or from a theme.
$button = apply_filters( 'ccdev_save_script_options', $save );

?>
<div class="wrap">
	<h2><?php _e( 'Website Development Tools', 'controlled-chaos-dev' ); ?></h2>
	<p class="description"><?php _e( 'A few tools to help you test and tune.', 'controlled-chaos-dev' ); ?></p>
	<hr />
	<h2 class="nav-tab-wrapper">
        <?php echo implode( $page_tabs ); ?>
    </h2>
    <form method="post" action="options.php">
        <?php
        settings_fields( $do_fields );
        do_settings_sections( $do_section );
        ?>
        <p class="submit"><?php submit_button( $button, 'primary', '', false, [] ); ?></p>
    </form>
</div>