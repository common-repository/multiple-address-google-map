<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://aliashiquemohammad.com
 * @since      1.0.0
 *
 * @package    Google_Map_Multiple_Address
 * @subpackage Google_Map_Multiple_Address/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php 
//add_shortcode( 'googlemap_multiple_address', 'googlemap_multiple_address_callback' ); 
function googlemap_multiple_address_callback() {
	ob_start();
	?>

	<div id="testuram"></div>
	<?php 
	$output = ob_get_clean();
	echo $output;
}