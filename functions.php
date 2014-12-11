<?php

class CMS_Theme {
	/**
	 * Setup theme hooks.
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'display_settings' ) );
	}

	/**
	 * Register the settings fields to capture CMS template information.
	 */
	public function display_settings() {
		register_setting( 'general', 'wsuwp_cms_template', array( $this, 'sanitize_template_data' ) );
		add_settings_field( 'wsuwp-cms-template', 'WSU CMS Template Settings', array( $this, 'cms_template_settings' ), 'general', 'default', array( 'label_for' => 'wsuwp_cms_template' ) );
	}

	/**
	 * Sanitize saved CMS template information.
	 *
	 * @param $data
	 *
	 * @return mixed
	 */
	public function sanitize_template_data( $settings ) {
		$clean_settings = array();

		foreach( $settings as $setting => $data ) {
			if ( ! in_array( $setting, array( 'host', 'title', 'id', 'url' ) ) ) {
				continue;
			}

			if ( 'id' === $setting ) {
				$clean_settings['id'] = absint( $data );
			} else {
				$clean_settings [ $setting ] = sanitize_text_field( $data );
			}

		}

		return $clean_settings;
	}

	/**
	 * Display CMS template settings for input.
	 */
	public function cms_template_settings() {
		$cms_template = get_option( 'wsuwp_cms_template', array() );
		?>
		<div class="wsuwp-cms-temlate-settings">
			<label for="cms-server-host">CMS Hostname:</label>
			<input id="cms-server-host" name="wsuwp_cms_template[host]" value="<?php if ( isset( $cms_template['host'] ) ) : echo esc_attr( $cms_template['host'] ); endif; ?>" />
			<label for="cms-template-id">CMS Template ID:</label>
			<input id="cms-template-id" name="wsuwp_cms_template[id]" value="<?php if ( isset( $cms_template['id'] ) ) : echo esc_attr( $cms_template['id'] ); endif; ?>" />
			<label for="cms-template-title">CMS Title:</label>
			<input id="cms-template-title" name="wsuwp_cms_template[title]" value="<?php if ( isset( $cms_template['title'] ) ) : echo esc_attr( $cms_template['title'] ); endif; ?>" />
			<label for="cms-template-url">CMS URL:</label>
			<input id="cms-template-url" name="wsuwp_cms_template[url]" value="<?php if ( isset( $cms_template['url'] ) ) : echo esc_attr( $cms_template['url'] ); endif; ?>" />
		</div>
		<style>
			.wsuwp-cms-temlate-settings label {
				width: 13em;
				float: left;
				clear: left;
				line-height: 27px;
			}

			.wsuwp-cms-temlate-settings input {
				float: left;
			}
		</style>
	<?php
	}
}
new CMS_Theme();

add_action( 'widgets_init', 'upcms_theme_widgets_init' );
/**
 * Register sidebars used by the theme.
 */
function upcms_theme_widgets_init() {
	$widget_options = array(
		'before_widget' => '<p id="%1$s" class="widget %2$s">',
		'after_widget' => '</p>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	);
	register_sidebar( $widget_options );
}

function upcms_display_footer() {
	global $after;

	if ( ! empty( $after ) ) {
		echo $after;
	}
}