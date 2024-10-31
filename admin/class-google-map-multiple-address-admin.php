<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://aliashiquemohammad.com
 * @since      1.0.0
 *
 * @package    Google_Map_Multiple_Address
 * @subpackage Google_Map_Multiple_Address/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Google_Map_Multiple_Address
 * @subpackage Google_Map_Multiple_Address/admin
 * @author     Mohammad Ashique Ali <aliashiquemohammad@gmail.com>
 */
class Google_Map_Multiple_Address_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Google_Map_Multiple_Address_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Google_Map_Multiple_Address_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/google-map-multiple-address-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Google_Map_Multiple_Address_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Google_Map_Multiple_Address_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/google-map-multiple-address-admin.js', array( 'jquery' ), $this->version, false );

		$options = $this->get_options();
		$google_api_key = $options[ 'google_api_key' ];

		if( $google_api_key ){
			wp_register_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?key='.$google_api_key, array( 'jquery' ), $this->version, true );
		} else{
			wp_register_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?sensor=false', array( 'jquery' ), $this->version, true );
		}

		wp_enqueue_script( 'google-map' );

		wp_enqueue_media();
	}

	/**
	* Register the administration menu for this plugin into the WordPress Dashboard menu.
	*
	* @since    1.0.0
	*/

	public function add_plugin_admin_menu() {

	    /*
	     * Add a settings page for this plugin to the Settings menu.
	     *
	     * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
	     *
	     * Administration Menus: http://codex.wordpress.org/Administration_Menus
	     *
	     */
	    add_options_page( 'Google Map Multiple Address', 'Google Map', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
	    );
	}

	/**
	* Add settings action link to the plugins page.
	*
	* @since    1.0.0
	*/

	public function add_setting_action_links( $links ) {
		/*
		*  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
		*/
		$settings_link = array(
		'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __( 'Settings', $this->plugin_name) . '</a>',
		);
		return array_merge(  $settings_link, $links );

	}

	/**
	* Render the settings page for this plugin.
	*
	* @since    1.0.0
	*/

	public function display_plugin_setup_page() {
		include_once( 'partials/google-map-multiple-address-admin-display.php' );
	}

	/*
	* Validate the Google API KEY form in setting page
	*
	*/
	public function validate( $input ) {

	    $valid = array();

	    $valid[ 'google_api_key' ] = ( isset( $input[ 'google_api_key' ] ) && !empty( $input[ 'google_api_key' ] ) ) ? sanitize_text_field( $input[ 'google_api_key' ] ) : '' ;

	    $valid[ 'zoom_level' ] = ( isset( $input['zoom_level'] ) && !empty( $input[ 'zoom_level' ] ) ) ? sanitize_text_field( $input[ 'zoom_level' ] ) : '' ;

	    $valid[ 'style' ] = ( isset( $input['style'] ) && !empty( $input['style'] ) ) ? sanitize_text_field( $input[ 'style' ] ) : '' ;

	    $valid[ 'scroll' ] = ( isset( $input['scroll'] ) && !empty( $input['scroll'] ) ) ? sanitize_text_field( $input[ 'scroll' ] ) : 'false' ;
	    
	    $valid[ 'drag' ] = ( isset( $input['drag'] ) && !empty( $input['drag'] ) ) ? sanitize_text_field( $input[ 'drag' ] ) : 'false' ;
	    
	    $valid[ 'count' ] = ( isset( $input['count'] ) && !empty( $input['count'] ) ) ? sanitize_text_field( $input[ 'count' ] ) : 0 ;

	    $count = $valid['count'];
		
		for( $i=0; $i <= $count; $i++ ){
	    	
	    	$valid[ 'longitude'.$i ] = ( isset( $input['longitude'.$i] ) && !empty( $input[ 'longitude'.$i ] ) ) ? sanitize_text_field( $input['longitude'.$i] ) : '' ; 

		    $valid[ 'latitude'.$i ] = ( isset( $input['latitude'.$i] ) && !empty( $input[ 'latitude'.$i ] ) ) ? sanitize_text_field( $input[ 'latitude'.$i ] ) : '' ;

		    $valid[ 'info'.$i ] = ( isset( $input['info'.$i] ) && !empty( $input['info'.$i] ) ) ? sanitize_text_field( $input[ 'info'.$i ] ) : '' ;
	    
	    	$valid[ 'marker'.$i ] = ( isset( $input['marker'.$i] ) && !empty( $input['marker'.$i] ) ) ? esc_url( $input[ 'marker'.$i ] ) : '' ;
	    }


        if ( empty( $valid[ 'google_api_key' ] ) ) { 
            add_settings_error(
                    'google_api_key',                     // Setting title
                    'google_api_key_texterror',            // Error ID
                    'Please enter a google map API key.',     // Error message
                    'error'                         // Type of message
            );
        }
        

        if( isset( $_POST['google_map_multiple_address' ] ) && wp_verify_nonce( $_POST['google_map_multiple_address' ], 'google_map_multiple_address_form' ) ){
	    	add_settings_error(
                    'wp_nonce_error',                     
                    'google_map_wp_nonce_error',            
                    'Sorry, nonce could not be verifyed.',     
                    'error'                         
            );
   	 	}
	    
	    return $valid;
	}

	public function repeater( $input ){

		$repeater[ 'count' ] = ( isset( $input['count'] ) && !empty( $input['count'] ) ) ? sanitize_text_field( $input[ 'count' ] ) : 0 ;

	    $count = $valid['count'];

		$repeater[] = array();

	}

	/*
	* Saving the Google API key in table options in database
	*
	*/

	public function options_update() {

		register_setting( $this->plugin_name, $this->plugin_name, array( $this, 'validate' ) );	
		
	}

	/*
	* Getting all the options fields of the current plugins
	*
	*/
	function get_options(){

		$plugins_options	= get_option( $this->plugin_name);
		return $plugins_options;
	}

	


}
