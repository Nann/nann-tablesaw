<?php

/*
Plugin Name: Nann Tablesaw
Plugin URI: https://www.nannstudio.com/
Description: Tablesaw for homepage
Author: Nannchalermchai
Version: 1.0
Author URI: https://www.facebook.com/nannchalermchai
*/

function tablesaw_script() {
	global $post;
	$txt_tablesaw=get_post_meta( $post->ID, 'txt_tablesaw', true );


    if(is_front_page() or ( ! empty( $txt_tablesaw ) )){
        wp_enqueue_script( 'tablesaw-loadfont-js', plugin_dir_url( __FILE__ ) . 'js/loadfont.js' , array('jquery'), '2017-3', true );
        wp_enqueue_script( 'tablesaw-init-js', plugin_dir_url( __FILE__ ) . 'js/tablesaw-init.js' , array('jquery'), '2017-3', true );
        wp_enqueue_script( 'tablesaw-jquery-js', plugin_dir_url( __FILE__ ) . 'js/tablesaw.stackonly.jquery.js' , array('jquery'), '2017-3', true );
        wp_enqueue_script( 'tablesaw-stackonly-js', plugin_dir_url( __FILE__ ) . 'js/tablesaw.stackonly.js' , array('jquery'), '2017-3', true );

        wp_enqueue_style( 'tablesaw-demo-css', plugin_dir_url( __FILE__ ) . 'css/demo.css' , array() );
        wp_enqueue_style( 'tablesaw-demohead-css', plugin_dir_url( __FILE__ ) . 'css/demohead.css' , array() );
        wp_enqueue_style( 'tablesaw-stackonly-css', plugin_dir_url( __FILE__ ) . 'css/tablesaw.stackonly.css' , array() );
    }
}

add_action( 'wp_enqueue_scripts', 'tablesaw_script' );



/*********************************************************************/
/* Add Checkbox
/********************************************************************/
add_action( 'add_meta_boxes', 'add_tablesaw' );
function add_tablesaw() {
	add_meta_box('tablesaw_checkbox_id','Use Tablesaw', 'tablesaw_post_checkbox_callback_function', 'post', 'normal', 'high');
	add_meta_box('tablesaw_checkbox_id','Use Tablesaw', 'tablesaw_post_checkbox_callback_function', 'page', 'normal', 'high');
}
function tablesaw_post_checkbox_callback_function( $post ) {
	global $post;
	$txt_tablesaw=get_post_meta( $post->ID, 'txt_tablesaw', true );
?>
	
	<input type="checkbox" name="txt_tablesaw" value="yes" <?php echo (($txt_tablesaw=='yes') ? 'checked="checked"': '');?>/> YES
<?php
}

add_action('save_post', 'save_tablesaw'); 
function save_tablesaw($post_id){ 
	update_post_meta( $post_id, 'txt_tablesaw', $_POST['txt_tablesaw']);
}