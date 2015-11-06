<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title>
		   <?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' Archive - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
	</title>

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:600,700,400' rel='stylesheet' type='text/css'>

	<link href='http://fonts.googleapis.com/css?family=Lato:400,700,300,100' rel='stylesheet' type='text/css'>

	<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<link rel="stylesheet" href="blog.css">

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

	<?php wp_head(); ?>
	<script>
		$(document).ready(function ($) {

	    $(window).scroll(function () {
	        if ($(this).scrollTop() > 100) {
	            $('.scrollup').fadeIn();
	        } else {
	            $('.scrollup').fadeOut();
	        }
	    });

	    $('.scrollup').click(function () {
	        $("html, body").animate({
	            scrollTop: 0
	        }, 600);
	        return false;
	    });

	});
	</script>


</head>

<body <?php body_class(); ?>>
	<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.0";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>

<div class="todo">
	<section id="head" class="container-fluid margin-down">
		<div class="container">
			<div class="logo col-xs-12 col-sm-12 col-lg-4">
				<a href="/">
					<img class="img-responsive" src="/wp-content/themes/theme-master/images/cabecera_logo.png">
				</a>
			</div>

			<div class="container contenido-header col-xs-12 col-sm-12 col-lg-8 margin-up">
				<nav class="navbar navbar-justified" role="navigation">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<?php get_menu_bootstrap(); ?>
				</nav>
			</div>
		</div>
	</section>
