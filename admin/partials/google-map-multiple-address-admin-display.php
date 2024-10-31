<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://aliashiquemohammad.com
 * @since      1.0.0
 *
 * @package    Google_Map_Multiple_Address
 * @subpackage Google_Map_Multiple_Address/admin/partials
 */

//getting all the option values of the 
$options 		= get_option( $this->plugin_name );

//assigning values to the options
$google_api_key = $options[ 'google_api_key' ];
$zoom_level 	= $options[ 'zoom_level' ];
$style 			= $options[ 'style' ];
$scroll			= $options[ 'scroll' ];
$drag			= $options[ 'drag' ];
$count			= $options[ 'count' ]; ?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap google-map-multiple-address-settings">

	<form method="post" name="google_map_options" action="options.php">
		<?php 
		wp_nonce_field( 'google_map_multiple_address', 'google_map_multiple_address_form' ); 
		for ( $i=0; $i <= $count; $i++ ){

			$data[ $i ] = array(
							'longitude'	=> $options[ 'longitude'.$i ],
							'latitude' 	=> $options[ 'latitude'.$i ],
							'info'		=> $options[ 'info'.$i ],
							'marker'	=> $options[ 'marker'.$i ],
						);
		}
		
		settings_fields( $this->plugin_name);
		do_settings_sections($this->plugin_name);

		?>
		<table class="form-table google-map-settings">
			<tr>
				<th class="row-title"><?php esc_attr_e( 'Google Map Settings', $this->plugin_name ); ?></th>

			</tr>

			<tr valign="top" class="alternate">
				<td scope="row">
					<label><?php _e( 'Google Map API KEY:', $this->plugin_name ); ?></label>
				</td>
				<td>
					<input type="text" name="<?php echo $this->plugin_name;?>[google_api_key]" value="<?php echo $google_api_key; ?>" class="regular-text" />
				</td>
			</tr>

			<tr valign="top">
				<td scope="row"></td>
				<td>
					<?php esc_attr_e( 'Why API KEY is essentials? Please follow the following link to get to know more about API KEY', $this->plugin_name );?><br>
					<a target="_blank" href="https://developers.google.com/maps/documentation/javascript/tutorial">
						<?php _e( 'Get Started with Google Map', $this->plugin_name ); ?>
					</a>
				</td>
			</tr>
		</table>

		<div class="form-table google-map-repeater">

			<ul class="google-map-repeater-heading">
				<li><?php esc_attr_e( 'Latitude:', $this->plugin_name ); ?></li>
				<li><?php esc_attr_e( 'Longitude:', $this->plugin_name ); ?></li>
				<li><?php esc_attr_e( 'Info Box:', $this->plugin_name ); ?></li>
				<li><?php esc_attr_e( 'Marker:', $this->plugin_name ); ?></li>
			</ul>
			<?php

			$c = 0;
			foreach ( $data as $row ){
				$longitude 	= $row[ 'longitude' ];
				$latitude 	= $row[ 'latitude' ];
				$info 		= $row[ 'info' ];
				$marker 	= $row[ 'marker' ];

				//var_dump( $longitude );
				//die();
				if( !empty( $longitude ) || !empty ( $latitude ) || !empty( $info ) || !empty( $marker ) || $c == 0){
				?>
				<ul class="google-map-repeater-field" id="google-row-<?php echo $c; ?>">
					<li>
						<input type="text" id="latitude<?php echo $c; ?>" name="<?php echo $this->plugin_name; ?>[latitude<?php echo $c; ?>]"
							   value="<?php echo $latitude; ?>" class="regular-text"/>
					</li>
					<li>
						<input type="text" id="longitude<?php echo $c; ?>" name="<?php echo $this->plugin_name; ?>[longitude<?php echo $c; ?>]"
							   value='<?php echo $longitude; ?>' class="regular-text"/>
					</li>
					<li>
						<input type="text" id="info<?php echo $c; ?>" name="<?php echo $this->plugin_name; ?>[info<?php echo $c; ?>]"
							   class="regular-text" value="<?php echo $info; ?>"/>
					</li>

					<li>
					<span class="marker-holder">
						<?php
						if ( !empty( $marker ) ) { ?>
							<img src="<?php echo $marker; ?>"/>
							<?php
						} ?>
					</span>
						<input type="text" id="marker<?php echo $c; ?>" name="<?php echo $this->plugin_name; ?>[marker<?php echo $c; ?>]"
							   class="image_url hidden regular-text" value="<?php echo $marker; ?>"/>

						

						<input type="button" name="<?php echo $this->plugin_name; ?>[upload-btn]"
							   class="button-secondary upload-btn" value="Upload Marker">
						<?php 
						if ( $c > 0) {	
							$class =""; 
						} else{ 
							$class="hidden"; 
						} ?>
						<span class="remove-row <?php echo $class; ?>"><a href="javascript:void(0)">X</a></span>
						
					</li>

				</ul>
				<?php
				$c++;
			}
				
			} ?>
			<input type="text" name="<?php echo $this->plugin_name;?>[count]" class="count-box hidden regular-text" value="<?php echo $count; ?>" />
			<span class="google-map-repeater-button-wrapper">
				<a href="javascript:void(0)" class="button-primary google-map-repeater-button">
					<?php _e( 'ADD NEW MAP', $this->plugin_name ); ?>
				</a>
						
			</span>

		</div>
		<table class="form-table">

			<tr valign="top">
				<td scope="row">
					<label><?php esc_attr_e( 'Zoom Level ( Default value is 12 ):', $this->plugin_name ); ?></label>

				</td>
				<td>
				<?php 
				//checking if the zoom level is empty
				if( !empty( $zoom_level ) ){
					$zoom = $zoom_level;
				} else{
					//setting default value as 12
					$zoom = 12;
				}

				?>
					<input type="text"  id="zoom" name="<?php echo $this->plugin_name;?>[zoom_level]" value="<?php echo $zoom; ?>" class="regular-text" />
				</td>
			</tr>

			<tr valign="top" class="alternate">
				<td scope="row">
					<label><?php esc_attr_e( 'Scrollable:', $this->plugin_name ); ?></label>

				</td>
				<td>
					<label>
					<?php 
					if( $scroll == 'true' ){ ?>
						<input type="radio" name="<?php echo $this->plugin_name;?>[scroll]" value="<?php echo $scroll; ?>" checked/>
					<?php 
					} else { ?>
						<input type="radio" name="<?php echo $this->plugin_name;?>[scroll]" value="true"/>
					<?php 
					}; ?>
						<span><?php esc_attr_e( 'Enable', $this->plugin_name ); ?></span>
					</label><br>
					<label>
					<?php 
					if( $scroll == 'false' ){ ?>
						<input type="radio" name="<?php echo $this->plugin_name;?>[scroll]" value="<?php echo $scroll; ?>" checked/>
					<?php 
					} else { ?>
						<input type="radio" name="<?php echo $this->plugin_name;?>[scroll]" value="false"/>
					<?php 
					}; ?>
						<span><?php esc_attr_e( 'Disable', $this->plugin_name ); ?></span>
					</label>
				</td>
			</tr>

			<tr valign="top">
				<td scope="row">
					<label><?php esc_attr_e( 'Draggable:', $this->plugin_name ); ?></label>

				</td>
				<td>
					<label>
					<?php 
					if( $drag == 'true' ){ ?>
						<input type="radio" name="<?php echo $this->plugin_name;?>[drag]" value="<?php echo $drag; ?>" checked/>
					<?php 
					} else { ?>
						<input type="radio" name="<?php echo $this->plugin_name;?>[drag]" value="true"/>
					<?php 
					}; ?>
						<span><?php esc_attr_e( 'Enable', $this->plugin_name ); ?></span>
					</label><br>
					<label>
					<?php 
					if( $drag == 'false' ){ ?>
						<input type="radio" name="<?php echo $this->plugin_name;?>[drag]" value="<?php echo $drag; ?>" checked/>
					<?php 
					} else { ?>
						<input type="radio" name="<?php echo $this->plugin_name;?>[drag]" value="false"/>
					<?php 
					}; ?>
						<span><?php esc_attr_e( 'Disable', $this->plugin_name ); ?></span>
					</label>
				</td>
			</tr>

			<tr valign="top" class="alternate">
				<td scope="row">
					<label><?php _e( 'Style (Should be in JSON format ):', $this->plugin_name ); ?></label>
				</td>
				<td>
					<textarea id="style" name="<?php echo $this->plugin_name;?>[style]" cols="100" rows="10"><?php if( $style ){ echo $style; } ?></textarea><br>
					<label><a href="https://snazzymaps.com" target="_blank"><?php esc_attr_e( 'You can get the style of Map from here', $this->plugin_name ); ?></label>
				</td>
			</tr>

			<tr valign="top">
				<td scope="row">
					<input class="button-primary" id="submit-setting" type="submit" name="submit-setting" value="<?php esc_attr_e( 'Save' ); ?>" />
				</td>

			</tr>

		</table>


	</form>
	<!-- #post-body .metabox-holder .columns-2 -->
</div>
<div class="google-map-preview">

	<?php
	if( $options['longitude0'] && $options['latitude0'] && $google_api_key ){ ?>
		<h3><?php _e( 'Preview Map', $this->plugin_name ); ?>
		<div id="admin-map"  data-serialize='<?php echo $ser_data; ?>' data-zoom="<?php echo $zoom_level; ?>" data-style='<?php echo $style; ?>' data-scroll="<?php echo $scroll; ?>" data-drag="<?php echo $drag; ?>"></div>
	<?php
	} else{ ?>
		<div id="admin-map"><?php _e( 'Sorry! No Preview Available', $this->plugin_name ); ?></div>
	<?php
	}?>
</div>
<!-- #poststuff -->

</div> <!-- .wrap -->