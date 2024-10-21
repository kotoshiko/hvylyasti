<?php

function hv_setup() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'hv_setup' );

function hv_gutenberg_support() {

	add_theme_support( 'align-wide' );

	add_theme_support( 'editor-styles' );

	add_editor_style( 'editor-style.css' );

	add_theme_support( 'editor-color-palette', array(
		array(
			'name' => __( 'Primary', 'hvylyasti-theme' ),
			'slug' => 'primary',
			'color' => '#0073aa',
		),
	) );
}
add_action( 'after_setup_theme', 'hv_gutenberg_support' );

function hv_enqueue_scripts() {
	wp_enqueue_style( 'hv-style', get_stylesheet_uri() );

}
add_action( 'wp_enqueue_scripts', 'hv_enqueue_scripts' );
