<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Product Pulse
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header" role="banner">
        <div class="info-bar">
            <div class="site-header-inner">
                <div class="site-branding">
                    <div class="site-title-wrap"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><h1 class="site-title"><?php bloginfo( 'name' ); ?></h1></a></div>
                    <div class="site-title-wrap"><h2 class="site-description"><?php bloginfo( 'description' ); ?></h2></div>
                </div>
            </div>
        </div>
	</header><!-- #masthead -->

    <div class="site-content-wrapper">
	<div id="content" class="site-content">
