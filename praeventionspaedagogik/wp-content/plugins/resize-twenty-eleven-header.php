<?php
/*
Plugin Name: Resize Twenty Eleven Header
Plugin URI: http://madebyraygun.com/lab/resize-twenty-eleven-header
Description: Input custom height and width for the header image in Twenty Eleven.
Author: Dalton Rooney
Version: 0.1.1
Author URI: http://madebyraygun.com
*/ 


/* Copyright 2011 Raygun Design LLC (email : contact@madebyraygun.com)
This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/ 

register_activation_hook( __FILE__, 'resize_header_install' );

function resize_header_install() { 
	$resize_header_options = array('width'	=> HEADER_IMAGE_WIDTH, 'height' => HEADER_IMAGE_HEIGHT);
	add_option( 'resize_header_options', $resize_header_options );
}

function resize_header_height($size) {
	$options = get_option( 'resize_header_options' );
   	return $options['height'];
}
function resize_header_width($size) {
  $options = get_option( 'resize_header_options' );
   	return $options['width'];
}

add_filter('twentyeleven_header_image_height','resize_header_height');
add_filter('twentyeleven_header_image_width','resize_header_width');

// create the admin menu
add_action( 'admin_menu', 'add_resize_header_option_page' );

function add_resize_header_option_page() {
	add_theme_page('Resize Header', 'Resize Header', 'edit_theme_options', __FILE__, 'resize_header_options_page');
}

function resize_header_options_page() { 	// Output the options page
	$options = get_option( 'resize_header_options' );
?>
	<div class="wrap">
		<form method="post" action="options.php">

		<?php wp_nonce_field('update-options'); ?>

		<h2>Resize theme header image size</h2>

		<table class="form-table">

		<tr valign="top">
			<th scope="row">Width</th><br />
			<td><input type="text" name="resize_header_options[width]" value="<?php echo $options['width']; ?>"/>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">Height</th><br />
			<td><input type="text" name="resize_header_options[height]" value="<?php echo $options['height']; ?>"/>
			</td>
		</tr>

		</table>

		<input type="hidden" name="page_options" value="resize_header_options" />
		<input type="hidden" name="action" value="update" />	
		<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</form>

<p style="margin-top:100px">
	<code>Made by <a href="http://madebyraygun.com">Raygun</a>. Check out our <a href="http://madebyraygun.com/lab/">other plugins</a>, and if you have any problems, stop by our <a href="http://madebyraygun.com/support/forum/">support forum</a>!</code></p>

	</div><!--//wrap div-->
<?php } ?>