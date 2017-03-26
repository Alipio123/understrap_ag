<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */
	$container = get_theme_mod( 'understrap_container_type' );
	$header_layout = get_theme_mod( 'understrap_header_layout' );
	$topbar_status = get_theme_mod( 'understrap_topbar_status' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="body_canvas" class="hfeed site canvas-slid" id="page">

	<!-- ******************* The Topbar Area ******************* -->
	<?php if( $topbar_status == "topbar-enable" || empty($topbar_status) ){ ?>
		<div class="topbar">
			<?php if ( 'container' == $container ) : ?>
				<div class="container">
			<?php endif; ?>

				<div class="row align-items-center">
					<div class="col-md-6 text-left">
						<?php dynamic_sidebar( 'topbar-left' ); ?>
					</div>
					<div class="col-md-6 text-right">
						<?php dynamic_sidebar( 'topbar-right' ); ?>
					</div>
				</div>


			<?php if ( 'container' == $container ) : ?>
				</div><!-- .container -->
			<?php endif; ?>
		</div>
	<?php } ?>

	<!-- ******************* The Navbar Area ******************* -->

	<?php 
		if( $header_layout == "header-inline" || empty( $header_layout ) ){
			get_template_part( 'header-template/template-header', 'inline' ); 
		}elseif( $header_layout == "header-classic" ){
			get_template_part( 'header-template/template-header', 'classic' ); 
		}elseif( $header_layout == "header-split" ){
			get_template_part( 'header-template/template-header', 'split' ); 
		}
	?>
