<?php
/**
* Header actions used by response. 
*
* Author: Tyler Cunningham
* Copyright: © 2012
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package response
* @since 1.0
*/

/**
* response header actions
*/
add_action( 'response_after_head_tag', 'response_font' );
add_action( 'response_head_tag', 'response_html_attributes' );
add_action( 'response_head_tag', 'response_meta_tags' );
add_action( 'response_head_tag', 'response_title_tag' );
add_action( 'response_head_tag', 'response_link_rel' );

add_action( 'response_header_sitename', 'response_header_sitename_content');
add_action( 'response_header_site_description', 'response_header_site_description_content' );
add_action( 'response_header_social_icons', 'response_header_social_icons_content' );

add_action( 'response_logo_menu', 'response_logo_menu_content');
add_action( 'response_description_icons', 'response_description_icons_content');

add_action( 'response_navigation', 'response_nav' );
add_action( 'response_404_content', 'response_404_content_handler' );

/**
* Establishes the theme font family.
*
* @since 1.0
*/
function response_font() {
	global $ec_themeslug, $options; //Call global variables
	$family = apply_filters( 'response_default_font_family', 'Helvetica, serif' );
	
	if ($options->get($ec_themeslug.'_font') == "" ) {
		$font = apply_filters( 'response_default_font', 'Arial' );
	}		
	else {
		$font = $options->get($ec_themeslug.'_font'); 
	} ?>
	
	<body style="font-family:'<?php echo ereg_replace("[^A-Za-z0-9]", " ", $font ); ?>', <?php echo $family; ?>" <?php body_class(); ?> > <?php
}

/**
* Establishes the theme HTML attributes
*
* @since 1.0
*/
function response_html_attributes() { ?>
<!doctype html>
<!--[if lt IE 7 ]> <html class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class=""> <!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?>>
<head profile="http://gmpg.org/xfn/11"> <?php 
}

/**
* Establishes the theme META tags (including SEO options)
*
* @since 1.0
*/
function response_meta_tags() { ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> <?php
	global $ec_themeslug, $options, $post; //Call global variables
	if(!$post) return; // in case of 404 page or something
	$title = get_post_meta($post->ID, 'seo_title' , true);
	$pagedescription = get_post_meta($post->ID, 'seo_description' , true);
	$keywords = get_post_meta($post->ID, 'seo_keywords' , true);  ?>

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="distribution" content="global" />

<meta name="language" content="en" /> 
<!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width"/><?php

	if ($options->get($ec_themeslug.'_home_title') != '' AND is_front_page()) { ?>
<meta name='title' content='<?php echo ($options->get($ec_themeslug.'_home_title')) ;?>'/> <?php
	}
	if ($options->get($ec_themeslug.'_home_description') != '' AND is_front_page()) { ?>
<meta name='description' content='<?php echo ($options->get($ec_themeslug.'_home_description')) ;?>' /> <?php
	}
	if ($options->get($ec_themeslug.'_home_keywords') != '' AND is_front_page()) { ?>
<meta name='keywords' content=' <?php echo ($options->get($ec_themeslug.'_home_keywords')) ; ?>' /> <?php
	}
	
	if ($title != '' AND !is_front_page()) {
		echo "<meta name='title' content='$title' />";
	}
	if ($pagedescription != '' AND !is_front_page()) {
		echo "<meta name='description' content='echo $pagedescription'/>";
	}
	if ($keywords != '' AND !is_front_page()) {
		echo "<meta name='keywords' content='$keywords'/>";
	} 
}

/**
* Establishes the theme title tags.
*
* @since 1.0
*/
function response_title_tag() {
	global $options, $ec_themeslug, $query, $post; 
	$blogtitle = ($options->get($ec_themeslug.'_home_title'));
	if (!is_404() && !is_search()) {
		$title = get_post_meta($post->ID, 'seo_title' , true);
	}
	else {
		$title = '';
	}

	echo "<title>";
	
	if (function_exists('is_tag') && is_tag()) { /*Title for tags */
		bloginfo('name'); echo ' - '; single_tag_title("Tag Archive for &quot;"); echo '&quot;  ';
	}
	elseif (is_archive()) { /*Title for archives */ 
		bloginfo('name'); echo ' - '; wp_title(''); echo ' Archive '; 
	}    
	elseif (is_search()) { /*Title for search */ 
		bloginfo('name'); echo ' - '; echo 'Search for &quot;'.get_search_query().'&quot;  '; 
	}    
	elseif (is_404()) { /*Title for 404 */
		bloginfo('name'); echo ' - '; echo 'Not Found '; 
	}
	elseif (is_front_page() AND !is_page() AND $blogtitle == '') { /*Title if front page is latest posts and no custom title */
		bloginfo('name'); echo ' - '; bloginfo('description'); 
	}
	elseif (is_front_page() AND !is_page() AND $blogtitle != '') { /*Title if front page is latest posts with custom title */
		bloginfo('name'); echo ' - '; echo $blogtitle ; 
	}
	elseif (is_front_page() AND is_page() AND $title == '') { /*Title if front page is static page and no custom title */
		bloginfo('name'); echo ' - '; bloginfo('description'); 
	}
	elseif (is_front_page() AND is_page() AND $title != '') { /*Title if front page is static page with custom title */
		bloginfo('name'); echo ' - '; echo $title ; 
	}
	elseif (is_page() AND $title == '') { /*Title if static page is static page with no custom title */
		bloginfo('name'); echo ' - '; wp_title(''); 
	}
	elseif (is_page() AND $title != '') { /*Title if static page is static page with custom title */
		bloginfo('name'); echo ' - '; echo $title ; 
	}
	elseif (is_page() AND is_front_page() AND $blogtitle == '') { /*Title if blog page with no custom title */
		bloginfo('name'); echo ' - '; wp_title(''); 
	}
	elseif ($blogtitle != '') { /*Title if blog page with custom title */ 
		bloginfo('name'); echo ' - '; echo $blogtitle ; 
	}
	else { /*Title if blog page without custom title */
		bloginfo('name'); echo ' - '; wp_title(''); 
	}
	echo "</title>";    
}

/**
* Sets the header link rel attributes
*
* @since 1.0
*/
function response_link_rel() {
	global $ec_themeslug, $options; //Call global variables
	$favicon = $options->get($ec_themeslug.'_favicon'); //Calls the favicon URL from the theme options 
	
	if ($options->get($ec_themeslug.'_font') == "" AND $options->get($ec_themeslug.'_custom_font') == "") {
		$font = apply_filters( 'synapse_default_font', 'Arial' );
	}		
	elseif ($options->get($ec_themeslug.'_custom_font') != "" && $options->get($ec_themeslug.'_font') == 'custom') {
		$font = $options->get($ec_themeslug.'_custom_font');	
	}	
	else {
		$font = $options->get($ec_themeslug.'_font'); 
	} 
	?>
	
<link rel="shortcut icon" href="<?php echo stripslashes($favicon['url']); ?>" type="image/x-icon" />

<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/core/css/foundation.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/core/css/app.css" type="text/css" />
<!--[if IE]>
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/core/css/ie.css" type="text/css" />
<![endif]-->
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/shortcode.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/elements.css" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/style.css" type="text/css" />


<?php if (is_child_theme()) :  //add support for child themes?>
	<link rel="stylesheet" href="<?php echo bloginfo('stylesheet_directory') ; ?>/style.css" type="text/css" />
<?php endif; ?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<link href='http://fonts.googleapis.com/css?family=<?php echo $font ; ?>' rel='stylesheet' type='text/css' /> <?php
}


/**
* Header left content (sitename or logo)
*
* @since 1.0
*/
function response_header_sitename_content() {
	global $ec_themeslug, $options; //Call global variables
	$logo = $options->get($ec_themeslug.'_logo'); //Calls the logo URL from the theme options

if ($options->get($ec_themeslug.'_custom_logo') == '1') { ?>
	<div id="logo">
		<a href="<?php echo home_url(); ?>/"><img src="<?php echo stripslashes($logo['url']); ?>" alt="logo"></a>
	</div> <?php
	}
						
	else{ ?>
		<h1 class="sitename"><a href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?> </a></h1>
		<?php
	}						 
}


function response_header_site_description_content() {
	global $ec_themeslug, $options; ?>
	
	<div id="description">
		<h1 class="description"><?php bloginfo('description'); ?>&nbsp;</h1>
	</div> <?php
}

/**
* Description/Icons
*
* @since 1.0
*/
function response_description_icons_content() {
?>

<div id="subheader">
	<div class="container">
		<div class="row">	
			
			<div class="five columns">
				
			<!-- Begin @Core header description hook -->
				<?php response_header_site_description(); ?> 
			<!-- End @Core header description hook -->
			
				
			</div>	
			
			<div class="seven columns">
			
			<!-- Begin @Core header social icon hook -->
				<?php response_header_social_icons(); ?> 
			<!-- End @Core header contact social icon hook -->	
						
			</div>	

		
		</div><!--end row-->
	</div>
</div>
<?php
}

/**
* Logo/Menu
*
* @since 1.0
*/
function response_logo_menu_content() {
	global $ec_themename;

?>

<div id="header">
	<div class="container">
		<div class="row">	
			
			<div class="five columns"">
				
				<!-- Begin @Core header sitename hook -->
					<?php response_header_sitename(); ?> 
				<!-- End @Core header sitename hook -->
			
			</div>	
			
			<div class="seven columns">
			<div id="nav">
			<?php wp_nav_menu( array(
			'items_wrap'      => '<ul id="nav_menu">%3$s</ul>',
			'fallback_cb' => $ec_themename.'_menu_fallback',
		    'theme_location' => 'header-menu' // Setting up the location for the main-menu, Main Navigation.
			    )
			);
	    	?>
			</div>					
			</div>	
		
		</div><!--end row-->
	</div>
</div>
<?php
}

/**
* Social icons
*
* @since 1.0
*/
function response_header_social_icons_content() { 
	global $options, $ec_themeslug; //call globals
	
	$facebook		= $options->get($ec_themeslug.'_facebook');
	$hidefacebook   = $options->get($ec_themeslug.'_hide_facebook_icon');
	$twitter		= $options->get($ec_themeslug.'_twitter');;
	$hidetwitter    = $options->get($ec_themeslug.'_hide_twitter_icon');;
	$gplus		    = $options->get($ec_themeslug.'_gplus');
	$hidegplus      = $options->get($ec_themeslug.'_hide_gplus_icon');
	$flickr		    = $options->get($ec_themeslug.'_flickr');
	$hideflickr     = $options->get($ec_themeslug.'_hide_flickr');
	$pinterest		= $options->get($ec_themeslug.'_pinterest');
	$hidepinterest	= $options->get($ec_themeslug.'_hide_pinterest');
	$linkedin		= $options->get($ec_themeslug.'_linkedin');
	$hidelinkedin   = $options->get($ec_themeslug.'_hide_linkedin');
	$youtube		= $options->get($ec_themeslug.'_youtube');
	$hideyoutube    = $options->get($ec_themeslug.'_hide_youtube');
	$googlemaps		= $options->get($ec_themeslug.'_googlemaps');
	$hidegooglemaps = $options->get($ec_themeslug.'_hide_googlemaps');
	$email			= $options->get($ec_themeslug.'_email');
	$hideemail      = $options->get($ec_themeslug.'_hide_email');
	$rss			= $options->get($ec_themeslug.'_rsslink');
	$hiderss   		= $options->get($ec_themeslug.'_hide_rss_icon');
	$folder = 'default';
	
	 ?>

	<div id="social">

		<div class="icons">
	
		<?php if ($hidefacebook == '1' AND $facebook != '' OR $hidefacebook == '' AND $facebook != '' ):?>
			<a href="<?php echo $facebook ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/facebook.png" alt="Facebook" /></a>
		<?php endif;?>
		<?php if ($hidefacebook == '1' AND $facebook == '' OR $hidefacebook == '' AND $facebook == '' ):?>
			<a href="http://facebook.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/facebook.png" alt="Facebook" /></a>
		<?php endif;?>
		<?php if ($hidetwitter == '1' AND $twitter != '' OR $hidetwitter == '' AND $twitter != '' ):?>
			<a href="<?php echo $twitter ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/twitter.png" alt="Twitter" /></a>
		<?php endif;?>
		<?php if ($hidetwitter == '1' AND $twitter == '' OR $hidetwitter == '' AND $twitter == '' ):?>
			<a href="http://twitter.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/twitter.png" alt="Twitter" /></a>
		<?php endif;?>
		<?php if ($hidegplus == '1' AND $gplus != ''  OR $hidegplus == '' AND $gplus != '' ):?>
			<a href="<?php echo $gplus ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/gplus.png" alt="Gplus" /></a>
		<?php endif;?>
		<?php if ($hidegplus == '1' AND $gplus == '' OR $hidegplus == '' AND $gplus == '' ):?>
			<a href="https://plus.google.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/gplus.png" alt="Gplus" /></a>
		<?php endif;?>
		<?php if ($hideflickr == '1' AND $flickr != '' ):?>
			<a href="<?php echo $flickr ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/flickr.png" alt="Flickr" /></a>
		<?php endif;?>
		<?php if ($hideflickr == '1' AND $flickr == '' ):?>
			<a href="https://flickr.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/flickr.png" alt="Flickr" /></a>
		<?php endif;?>
		<?php if ($hidepinterest == '1' AND $pinterest != '' ):?>
			<a href="<?php echo $pinterest ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/pinterest.png" alt="Pinterest" /></a>
		<?php endif;?>
		<?php if ($hidepinterest == '1' AND $pinterest == '' ):?>
			<a href="https://pinterest.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/pinterest.png" alt="Pinterest" /></a>
		<?php endif;?>
		<?php if ($hidelinkedin == '1' AND $linkedin != '' ):?>
			<a href="<?php echo $linkedin ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/linkedin.png" alt="LinkedIn" /></a>
		<?php endif;?>
		<?php if ($hidelinkedin == '1' AND $linkedin == '' ):?>
			<a href="http://linkedin.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/linkedin.png" alt="LinkedIn" /></a>
		<?php endif;?>
		<?php if ($hideyoutube == '1' AND $youtube != '' ):?>
			<a href="<?php echo $youtube ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/youtube.png" alt="YouTube" /></a>
		<?php endif;?>
		<?php if ($hideyoutube == '1' AND $youtube == '' ):?>
			<a href="http://youtube.com" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/youtube.png" alt="YouTube" /></a>
		<?php endif;?>
		<?php if ($hidegooglemaps == '1' AND $googlemaps != ''):?>
			<a href="<?php echo $googlemaps ?>" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/googlemaps.png" alt="Google Maps" /></a>
		<?php endif;?>
		<?php if ($hidegooglemaps == '1' AND $googlemaps == ''):?>
			<a href="http://google.com/maps" target="_blank" rel="me"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/googlemaps.png" alt="Google Maps" /></a>
		<?php endif;?>
		<?php if ($hideemail == '1' AND $email != ''):?>
			<a href="mailto:<?php echo $email ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/email.png" alt="E-mail" /></a>
		<?php endif;?>
		<?php if ($hideemail == '1' AND $email == ''):?>
			<a href="mailto:no@way.com" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/email.png" alt="E-mail" /></a>
		<?php endif;?>
		<?php if ($hiderss == '1' and $rss != '' OR $hiderss == '' and $rss != '' ):?>
			<a href="<?php echo $rss ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/rss.png" alt="RSS" /></a>
		<?php endif;?>
		<?php if ($hiderss == '1' and $rss == '' OR $hiderss == '' and $rss == '' ):?>
			<a href="<?php bloginfo('rss2_url'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social/<?php echo $folder; ?>/rss.png" alt="RSS" /></a>
		<?php endif;?>
	
		</div><!--end icons--> 
		
	</div><!--end social--> <?php
}

/**
* End
*/

?>