<?php
add_action( 'vc_before_init', 'g5plus_vcSetAsTheme' );
function g5plus_vcSetAsTheme() {
    vc_set_as_theme();
}

function g5plus_vc_remove_frontend_links() {
    vc_disable_frontend();
}
add_action( 'vc_after_init', 'g5plus_vc_remove_frontend_links' );

function g5plus_get_css_animation($css_animation){
    $output = '';
    if ($css_animation != '') {
        wp_enqueue_script('waypoints');
	    $output = ' wpb_animate_when_almost_visible g5plus-css-animation wpb_' . $css_animation;
    }
    return $output;
}

function g5plus_get_style_animation($duration, $delay) {
    $styles = array();
    if ($duration != '0' && !empty($duration)) {
        $duration = (float)trim($duration, "\n\ts");
        $styles[] = "-webkit-animation-duration: {$duration}s";
        $styles[] = "-moz-animation-duration: {$duration}s";
        $styles[] = "-ms-animation-duration: {$duration}s";
        $styles[] = "-o-animation-duration: {$duration}s";
        $styles[] = "animation-duration: {$duration}s";
    }
    if ($delay != '0' && !empty($delay)) {
        $delay = (float)trim($delay, "\n\ts");
        $styles[] = "opacity: 0";
        $styles[] = "-webkit-animation-delay: {$delay}s";
        $styles[] = "-moz-animation-delay: {$delay}s";
        $styles[] = "-ms-animation-delay: {$delay}s";
        $styles[] = "-o-animation-delay: {$delay}s";
        $styles[] = "animation-delay: {$delay}s";
    }
    if (count($styles) > 1) {
        return 'style="' . implode(';', $styles) . '"';
    }
    return implode(';', $styles);
}

function  g5plus_convert_hex_to_rgba($hex,$opacity=1) {
    $hex = str_replace("#", "", $hex);
    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    }
    else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }
    $rgba = 'rgba('.$r.','.$g.','.$b.','.$opacity.')';
    return $rgba;
}


function register_vc_map()
{
	if(!function_exists('vc_map_get_attributes')) return;
	$add_css_animation = array(
		'type' => 'dropdown',
		'heading' => __( 'CSS Animation', 'cupid' ),
		'param_name' => 'css_animation',
		'admin_label' => true,
		'value' => array(
			__( 'No', 'cupid' ) => '',
			__( 'Top to bottom', 'cupid' ) => 'top-to-bottom',
			__( 'Bottom to top', 'cupid' ) => 'bottom-to-top',
			__( 'Left to right', 'cupid' ) => 'left-to-right',
			__( 'Right to left', 'cupid' ) => 'right-to-left',
			__( 'Appear from center', 'cupid' ) => 'appear',
			__( 'FadeIn', 'cupid' ) => 'fadein'
		),
		'description' => __( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'js_composer' )
	);
	$add_duration_animation= array(
		'type' => 'textfield',
		'heading' => __( 'Animation Duration', 'cupid' ),
		'param_name' => 'duration',
		'value' => '',
		'description' => __( 'Duration in seconds. You can use decimal points in the value. Use this field to specify the amount of time the animation plays. <em>The default value depends on the animation, leave blank to use the default.</em>', 'cupid' ),
		'dependency'  => Array( 'element' => 'css_animation', 'value' => array( 'top-to-bottom','bottom-to-top','left-to-right','right-to-left','appear','fadein') ),
	);
	$add_delay_animation=array(
		'type' => 'textfield',
		'heading' => __( 'Animation Delay', 'cupid' ),
		'param_name' => 'delay',
		'value' => '',
		'description' => __( 'Delay in seconds. You can use decimal points in the value. Use this field to delay the animation for a few seconds, this is helpful if you want to chain different effects one after another above the fold.', 'cupid' ),
		'dependency'  => Array( 'element' => 'css_animation', 'value' => array( 'top-to-bottom','bottom-to-top','left-to-right','right-to-left','appear','fadein') ),
	);
	$params_row=array(
		array(
			'type'       => 'dropdown',
			'heading'    => __( 'Layout', 'cupid' ),
			'param_name' => 'layout',
			'value'      => array(
				__( 'Full Width', 'cupid' )  => 'wide',
				__( 'Container', 'cupid' ) => 'boxed',
				__( 'Container Fluid', 'cupid' ) => 'container-fluid',
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Full height row?', 'cupid' ),
			'param_name' => 'full_height',
			'description' => __( 'If checked row will be set to full height.', 'cupid' ),
			'value' => array( __( 'Yes', 'cupid' ) => 'yes' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Content position', 'cupid' ),
			'param_name' => 'content_placement',
			'value' => array(
				__( 'Middle', 'cupid' ) => 'middle',
				__( 'Top', 'cupid' ) => 'top',
			),
			'description' => __( 'Select content position within row.', 'cupid' ),
			'dependency' => array(
				'element' => 'full_height',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Use video background?', 'cupid' ),
			'param_name' => 'video_bg',
			'description' => __( 'If checked, video will be used as row background.', 'cupid' ),
			'value' => array( __( 'Yes', 'cupid' ) => 'yes' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'YouTube link', 'cupid' ),
			'param_name' => 'video_bg_url',
			'value' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k', // default video url
			'description' => __( 'Add YouTube link.', 'cupid' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Parallax', 'cupid' ),
			'param_name' => 'video_bg_parallax',
			'value' => array(
				__( 'None', 'cupid' ) => '',
				__( 'Simple', 'cupid' ) => 'content-moving',
				__( 'With fade', 'cupid' ) => 'content-moving-fade',
			),
			'description' => __( 'Add parallax type background for row.', 'cupid' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Parallax', 'cupid' ),
			'param_name' => 'parallax',
			'value' => array(
				__( 'None', 'cupid' ) => '',
				__( 'Simple', 'cupid' ) => 'content-moving',
				__( 'With fade', 'cupid' ) => 'content-moving-fade',
			),
			'description' => __( 'Add parallax type background for row (Note: If no image is specified, parallax will use background image from Design Options).', 'cupid' ),
			'dependency' => array(
				'element' => 'video_bg',
				'is_empty' => true,
			),
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', 'cupid' ),
			'param_name' => 'parallax_image',
			'value' => '',
			'description' => __( 'Select image from media library.', 'cupid' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __('Parallax speed', 'cupid'),
			'param_name' => 'parallax_speed',
			'value' =>'1.5',
			'dependency' => Array('element' => 'parallax','value' => array('content-moving','content-moving-fade')),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Show background overlay', 'cupid' ),
			'param_name' => 'overlay_set',
			'description' => __( 'Hide or Show overlay on background images.', 'cupid' ),
			'value' => array(
				__( 'Hide, please', 'cupid' ) =>'hide_overlay',
				__( 'Show Overlay Color', 'cupid' ) =>'show_overlay_color',
				__( 'Show Overlay Image', 'cupid' ) =>'show_overlay_image',
			)
		),
		array(
			'type'        => 'attach_image',
			'heading'     => __( 'Image Overlay:', 'cupid' ),
			'param_name'  => 'overlay_image',
			'value'       => '',
			'description' => __( 'Upload image overlay.', 'cupid' ),
			'dependency'  => Array( 'element' => 'overlay_set', 'value' => array( 'show_overlay_image' ) ),
		),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Overlay color', 'cupid' ),
			'param_name' => 'overlay_color',
			'description' => __( 'Select color for background overlay.', 'cupid' ),
			'value' => '',
			'dependency' => Array('element' => 'overlay_set','value' => array('show_overlay_color')),
		),
		array(
			'type' => 'number',
			'class' => '',
			'heading' => __( 'Overlay opacity', 'cupid' ),
			'param_name' => 'overlay_opacity',
			'value' =>'50',
			'min'=>'1',
			'max'=>'100',
			'suffix'=>'%',
			'description' => __( 'Select opacity for overlay.', 'cupid' ),
			'dependency' => Array('element' => 'overlay_set','value' => array('show_overlay_color','show_overlay_image')),
		),
		array(
			'type' => 'el_id',
			'heading' => __( 'Row ID', 'cupid' ),
			'param_name' => 'el_id',
			'description' => sprintf( __( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'cupid' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'cupid' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'cupid' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'cupid' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'cupid' )
		),
		$add_css_animation,
		$add_duration_animation,
		$add_delay_animation,
	);
    vc_map( array(
        'name' => __( 'Row', 'cupid' ),
        'base' => 'vc_row',
        'is_container' => true,
        'icon' => 'icon-wpb-row',
        'show_settings_on_create' => false,
        'category' => __( 'Content', 'cupid' ),
        'description' => __( 'Place content elements inside the row', 'cupid' ),
        'params' => $params_row,
        'js_view' => 'VcRowView'
    ) );
    vc_map( array(
        'name' => __( 'Row', 'cupid' ), //Inner Row
        'base' => 'vc_row_inner',
        'content_element' => false,
        'is_container' => true,
        'icon' => 'icon-wpb-row',
        'weight' => 1000,
        'show_settings_on_create' => false,
        'description' => __( 'Place content elements inside the row', 'cupid' ),
	    'params' => $params_row,
        'js_view' => 'VcRowView'
    ) );
}
add_action( 'vc_after_init', 'register_vc_map' );
?>