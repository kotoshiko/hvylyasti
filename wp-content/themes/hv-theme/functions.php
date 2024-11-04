<?php
function hv_theme_setup() {
	// Поддержка динамического заголовка
	add_theme_support( 'title-tag' );

	// Поддержка миниатюр
	add_theme_support( 'post-thumbnails' );

	// Регистрация меню
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'my-custom-theme' ),
	) );

	// Поддержка WooCommerce
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'hv_theme_setup' );

// Подключение стилей и скриптов
function hv_theme_scripts() {
	wp_enqueue_style( 'main-style', get_stylesheet_uri() );
	wp_enqueue_script( 'main-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'hv_theme_scripts' );