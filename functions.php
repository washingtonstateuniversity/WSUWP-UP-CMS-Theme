<?php

/**
 * Class CMS_Theme
 */
class CMS_Theme {

	/**
	 * Holds the "before" template data for output.
	 *
	 * @var string
	 */
	var $template_before = '';

	/**
	 * Holds the "after" template data for output.
	 *
	 * @var string
	 */
	var $template_after = '';

	/**
	 * Setup theme hooks.
	 */
	public function __construct() {
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
		add_action( 'admin_init', array( $this, 'display_settings' ) );
	}

	/**
	 * Register sidebars used by the theme.
	 */
	public function widgets_init() {
		$widget_options = array(
			'before_widget' => '<p id="%1$s" class="widget %2$s">',
			'after_widget' => '</p>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		);
		register_sidebar( $widget_options );
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
	 * @param array $settings
	 *
	 * @return mixed
	 */
	public function sanitize_template_data( $settings ) {
		$clean_settings = array();

		foreach( $settings as $setting => $data ) {
			if ( ! in_array( $setting, array( 'host', 'title', 'id', 'url', 'siteid', 'regionlist' ) ) ) {
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
			<label for="cms-template-siteid">Site ID:</label>
			<input id="cms-template-siteid" name="wsuwp_cms_template[siteid]" value="<?php if ( isset( $cms_template['siteid'] ) ) : echo esc_attr( $cms_template['siteid'] ); endif; ?>" />
			<label for="cms-template-regionlist">CMS Region List:</label>
			<input id="cms-template-regionlist" name="wsuwp_cms_template[regionlist]" value="<?php if ( isset( $cms_template['regionlist'] ) ) : echo esc_attr( $cms_template['regionlist'] ); endif; ?>" />
			<label for="cms-template-id">CMS Template ID:</label>
			<input id="cms-template-id" name="wsuwp_cms_template[id]" value="<?php if ( isset( $cms_template['id'] ) ) : echo esc_attr( $cms_template['id'] ); endif; ?>" />
			<label for="cms-template-title">CMS Title:</label>
			<input id="cms-template-title" name="wsuwp_cms_template[title]" value="<?php if ( isset( $cms_template['title'] ) ) : echo esc_attr( $cms_template['title'] ); endif; ?>" />
			<label for="cms-template-url">URL to highlight:</label>
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

	/**
	 * Retrieve template data from upstream and populate the properties of this class
	 * with that data.
	 *
	 * @param array $args
	 */
	public function get_template_data( $args = array() ) {
		$default_args = array(
			'host' => '',
			'title' => '',
			'templateid' => '',
			'regionlist' => 'body',
			'currenturl' => '',
			'siteid' => 1,
			'variables' => '',
		);

		// Ensure all keys exist as default args.
		$cms_template = wp_parse_args( get_option( 'wsuwp_cms_template', array() ), $default_args );
		// Allow uses of `get_template_data()` to override the default settings.
		$cms_template = wp_parse_args( $args, $cms_template );

		if ( empty( $cms_template['host'] ) ) {
			return;
		}

		$the_title =  single_post_title( '', false );
		if ( empty( $the_title ) ) {
			$the_title = $cms_template['title'];
		}

		$soapendpoint = 'http://' . esc_attr( $cms_template['host'] ) . '/edit/SoapService.asmx?wsdl';
		$client = new SoapClient( $soapendpoint, array( 'trace' => 1, 'exceptions' => 1 ) );

		$template_args = array(
			'title'      => esc_html( $the_title ),
			'templateid' => absint( $cms_template['id'] ),
			'regionlist' => esc_html( $cms_template['regionlist'] ),
			'currenturl' => esc_attr( $cms_template['url'] ),
			'siteid'     => absint( $cms_template['siteid'] ),
			'variables'  => '',
		);
		$template = $client->getTemplate( $template_args );
		$result = $template->getTemplateResult->string;

		if ( ! empty( $result[0] ) ) {
			$this->template_before = $result[0];
		}

		if ( ! empty( $result[1] ) ) {
			$this->template_after = str_replace( '</body>', '', $result[1] );
		}
	}
}
$wsuwp_cms_theme = new CMS_Theme();

/**
 * Output the "before" data provided from our call to the CMS Template.
 *
 * @param array $args
 */
function upcms_display_template_before( $args = array() ) {
	global $wsuwp_cms_theme;
	if ( empty( $wsuwp_cms_theme->template_before ) ) {
		$wsuwp_cms_theme->get_template_data( $args );
	}
	echo $wsuwp_cms_theme->template_before;
}

/**
 * Output the "after" data provided from our call to the CMS Template.
 */
function upcms_display_template_after() {
	global $wsuwp_cms_theme;
	if ( empty( $wsuwp_cms_theme->template_after ) ) {
		$wsuwp_cms_theme->get_template_data();
	}
	echo $wsuwp_cms_theme->template_after;
	wp_footer();
	echo '</body>';
}