<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class WP_Ajax_Example_Class {
    /**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
    public function __construct() {
        // Assets url
        $this->assets_url = esc_url( trailingslashit(WP_EXAMPLE_PLUGIN_DIR) );

        // Enqueue ajax JS script
        add_action( 'wp_enqueue_scripts', array($this, 'wb_enqueue_scripts_ajax_js' ), 100 );

        // Ajax action
        add_action( 'wp_ajax_nopriv_send_hello_world', array( $this, 'send_hello_world' ), 10, 1 );
        add_action( 'wp_ajax_send_hello_world', array( $this, 'send_hello_world' ), 10, 1 );
    }

    /**
	 * Load frontend Javascript.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function wb_enqueue_scripts_ajax_js () {
        // Enqueue ajax JS script
		wp_register_script( 'wp-ajax-example-frontend', esc_url( $this->assets_url ) . 'js/ajax.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'wp-ajax-example-frontend' );

        // Localize script, needed for ajax to work. We also send nonce, to make sure the request comes from the correct source
		wp_localize_script( 'wp-ajax-example-frontend', 'wp_example_admin_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'security'  => wp_create_nonce( 'exammple-security-nonce' )));
	} // End admin_enqueue_scripts ()

    /**
	 * Receive data from frontend
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function send_hello_world() {
        // Check nonce
        if ( ! check_ajax_referer( 'exammple-security-nonce', 'security', false ) ) {	
			wp_send_json_error( 'Invalid security token sent.' );	    
			wp_die();	  
		}

        // Sanitize data
		$get_object = esc_js($_POST['sendData']);
		$get_object = json_decode(str_replace('&quot;', '"', $get_object));

        $hello_world = $get_object->data;

        $return = array(
            'message' => 'Received data: ' . $hello_world
        );
         
        wp_send_json($return);
	}
}

new WP_Ajax_Example_Class();