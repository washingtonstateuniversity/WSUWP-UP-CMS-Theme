<?php

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

function upcms_display_sidebar() {
	global $sidebar;

	if ( ! empty( $sidebar ) ) {
		echo $sidebar;
	}
}