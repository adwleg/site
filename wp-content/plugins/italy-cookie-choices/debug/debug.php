<?php
/**
 * This will make shure the plugin files can't be accessed within the web browser directly.
 */
if ( !defined( 'WPINC' ) )
    die;
/**
 * This file is only for internal use
 */


/**
 * @link http://wordpress.stackexchange.com/questions/162862/wordpress-hooks-run-sequence
 * @link http://codex.wordpress.org/Plugin_API/Action_Reference
 * wp_footer (1)
 * wp_print_footer_scripts (1)
 * shutdown (1) 
 */
add_action( 'shutdown', function(){
	var_dump($GLOBALS['wp_actions']);
	foreach( $GLOBALS['wp_actions'] as $action => $count )
		printf( '%s (%d) <br/>' . PHP_EOL, $action, $count );
});


/**
 * Sperimentale, aggingereattributo style con altezza minima per quando
 * si attiva il lazyloading sulle immagini
 */
// function kia_attachment_attributes( $attr ) {
/**
 * @todo $attr è un array con 3 valori
 *       aggiungere un attributo style e dare min-height
 *       con altezza presa dalla misura dell'immagine
 *       Per esempio se è la misura media deve prendere il valore di 300px
 *       Se questo sistema funziona ricordarsi di togliere lo stile dentro il carousel
 */
// 	// var_dump($attr);
// 	return $attr;
// }
// add_filter('wp_get_attachment_image_attributes', 'kia_attachment_attributes', 10, 1);