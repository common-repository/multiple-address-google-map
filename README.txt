=== Google Map Multiple Address ===
Contributors: sranzan
Donate link: https://aliashiquemohammad.com
Tags: google, goolge-map, map, address, multiple, multiple-address
Requires at least: 4.0
Tested up to: 4.8
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Google Map Multiple Address gives you to show the map with multiple marker of various places in one map. 

== Description ==

This plugin allows the user to display the Google Map with multiple location by provided Longitude, Latitude, Marker Image and Information Box. 

Enable / Disable the mouse zoom in and out option on scroll event. 

Enable / Disable the map to be draggable.

You can customize the design of the map by just passing the style of the map with JSON format.

How it works:

1. Go to Setting -> Google Map

2. Enter Google Map API key which is essential for this plugin to work. 
	Get your API KEY: [Google Map API] (https://developers.google.com/maps/documentation/javascript/get-api-key)

3. Enter Longitude, Latitude to show the address you want to display in the map.

4. If you want to have multiple address to show, click on "Add New Map" button.

5. If you want to have mouse zoom in and out on scroll then ENABLE the Scrollable option. By default it is DISABLE.

6. If you want the map to be draggable on mouse movement then ENABLE the Draggable option. By default it is DISABLE. 

7. Enter any style in JSON format to customize the layout of the Google Map.


Thanks for all the suggestions, bug reports, translations and donations, they're frankly too many to be listed here!


== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `google-map-multiple-address.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `[googlemap_multiple_address]` in your page text editor or use do_shortcode() in any of the template files.

== Frequently Asked Questions ==

= Do the plugin works without providing Google Map API key ? =

No, the plugin will not work without the Google Map API key. 

= Can we have multiple address to be displayed in the map? =

Yes, this plugin can display multiple address with marker and info box in a map.

= Does the JSON format is required for styling the Google Map? =

Yes, you need to have JSON format value to be entered in the Style section to customize the Google Map.


== Screenshots ==

1. Showing various option of the maps.
2. Fields to enable and disable other options.
3. Multiple map address fields by clicking on "Add New Map".
4. Map Preview of the map below the "Save" button.
6. Dispalying the Map at front-end.


== Upgrade Notice ==

No upgrage notice for now.

== Changelog ==

1.0 - Released as plugin

1.1 - JavaScript Error on Dashboard is fixed.

1.2 - JavaScript Error on Frontend is fixed.