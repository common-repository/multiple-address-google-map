<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://aliashiquemohammad.com
 * @since      1.0.0
 *
 * @package    Google_Map_Multiple_Address
 * @subpackage Google_Map_Multiple_Address/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Google_Map_Multiple_Address
 * @subpackage Google_Map_Multiple_Address/public
 * @author     Mohammad Ashique Ali <aliashiquemohammad@gmail.com>
 */
class Google_Map_Multiple_Address_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/google-map-multiple-address-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/google-map-multiple-address-public.js', array( 'jquery' ), $this->version, false );

		/*
		* Getting Googel API key from the setting page
		* Enqueue the Google Map script to load
		*/
		
		$options = $this->get_options();
		$google_api_key = $options[ 'google_api_key' ];

		if( $google_api_key ){
			wp_register_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?key='.$google_api_key, array( 'jquery' ), $this->version, true );
		} else{
			wp_register_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?sensor=false', array( 'jquery' ), $this->version, true );
		}

		wp_enqueue_script( 'google-map' );

	}

	function shortcode_googlemap_multiple_address( $atts, $content = "" ){

		$options = $this->get_options();

		$google_api_key = $options[ 'google_api_key' ];
		$zoom_level 	= $options[ 'zoom_level' ];
		$style 			= $options[ 'style' ];
		$scroll			= $options[ 'scroll' ];
		$drag			= $options[ 'drag' ];
		$count			= $options[ 'count' ];

		
		for ( $i=0; $i <= $count; $i++ ){

			$data[ $i ] = array(
									'longitude'	=> $options[ 'longitude'.$i ],
									'latitude' 	=> $options[ 'latitude'.$i ],
									'info'		=> $options[ 'info'.$i ],
									'marker'	=> $options[ 'marker'.$i ],
								);
		}
		//var_dump( $data);
		$c = 0;
		foreach ( $data as $row ){
			$longitude 	= $row['longitude'];
			$latitude 	= $row['latitude'];
			$info 		= $row['info'];
			$marker 	= $row['marker'];

			//var_dump( $longitude );
			//die();
			if( !empty( $longitude ) || !empty ( $latitude ) || !empty( $info ) || !empty( $marker ) || $c == 0){ ?>
				<ul class="google-map-repeater-field hidden" id="google-row-<?php echo $c; ?>">
					<li>
						<input type="text" id="latitude<?php echo $c; ?>" name="<?php echo $this->plugin_name; ?>[latitude<?php echo $c; ?>]"
							   value="<?php echo $latitude; ?>" class="regular-text hidden"/>
					</li>
					<li>
						<input type="text" id="longitude<?php echo $c; ?>" name="<?php echo $this->plugin_name; ?>[longitude<?php echo $c; ?>]"
							   value='<?php echo $longitude; ?>' class="regular-text hidden"/>
					</li>
					<li>
						<input type="text" id="info<?php echo $c; ?>" name="<?php echo $this->plugin_name; ?>[info<?php echo $c; ?>]"
							   class="regular-text hidden" value="<?php echo $info; ?>"/>
					</li>

					<li>

						<input type="text" id="marker<?php echo $c; ?>" name="<?php echo $this->plugin_name; ?>[marker<?php echo $c; ?>]" class="image_url hidden regular-text" value="<?php echo $marker; ?>"/>
					</li>

				</ul>
			<?php
			$c++;
		}
			
		}

		ob_start();
		?>
		<div id="public-map" data-zoom="<?php echo $zoom_level; ?>" data-style='<?php echo $style; ?>' data-scroll="<?php echo $scroll; ?>" data-drag="<?php echo $drag; ?>"></div>
		<?php 
		$output = ob_get_clean();
		return $output;
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
