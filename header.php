<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">

	<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
	
	<meta name="viewport" content="width=device-width,initial-scale=1">
	
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/flexslider.css">
	<?php roots_stylesheets(); ?>
	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">

	<script src="<?php echo get_template_directory_uri(); ?>/js/libs/modernizr-2.0.6.min.js"></script>
	
	<?php wp_head(); ?>
	<?php roots_head(); ?>

</head>

<body <?php body_id(); ?> <?php $page_slug = $post->post_name; body_class($page_slug); ?>>

	<?php roots_wrap_before(); ?>
	<div id="wrap" class="container" role="document">
	<?php roots_header_before(); ?>
		<header id="banner" class="<?php global $roots_options; echo $roots_options['container_class']; ?>" role="banner">
			<?php roots_header_inside(); ?>
			<div class="container">
			    <div class="branding">
    	            <h1>
        				<a id="logo" href="<?php echo home_url(); ?>/">
                            <?php bloginfo('name'); ?>
        				</a>
    				</h1>
    				<p id="tagline">
    				    <?php echo get_bloginfo( 'description' ); ?>
    				</p>
				</div>
				<?php if ($roots_options['clean_menu']) { ?>
					<nav id="nav-main" role="navigation">
						<?php wp_nav_menu(array('theme_location' => 'primary_navigation', 'walker' => new roots_nav_walker())); ?>
					</nav>
					<?php 					
						$utility_nav = wp_get_nav_menu_object('Utility Navigation');
						$utility_nav_term_id = (int) $utility_nav->term_id;
						$menu_items = wp_get_nav_menu_items($utility_nav_term_id);					
						if ($menu_items || !empty($menu_items)) {
					?>
					<nav id="nav-utility">
						<?php wp_nav_menu(array('theme_location' => 'utility_navigation', 'walker' => new roots_nav_walker())); ?>
					</nav>
					<?php } ?>		
				<?php } else { ?>
					<nav id="nav-main" role="navigation">
						<?php wp_nav_menu(array('theme_location' => 'primary_navigation')); ?>
					</nav>
					<?php 					
						$utility_nav = wp_get_nav_menu_object('Utility Navigation');
						$utility_nav_term_id = (int) $utility_nav->term_id;
						$menu_items = wp_get_nav_menu_items($utility_nav_term_id);					
						if ($menu_items || !empty($menu_items)) {
					?>
					<nav id="nav-utility">
						<?php wp_nav_menu(array('theme_location' => 'utility_navigation')); ?>
					</nav>
					<?php } ?>								
				<?php } ?>
				
				<div id="contact" class="contact-menu">
					<div id="robert-p-russo-cpa-vcard" class="vcard">
					    <div class="find">
    						<div class="fn org">
    							Robert P. Russo, CPA
    						</div>
    					 	<div class="adr">
    							<div class="street-address">14 Penn Plaza</div>
    							<span class="suite">Suite 1611</span>
    							<span class="locality">New York</span>, 
    							<span class="region">NY</span>, 
    							<span class="postal-code">10122</span>
    						</div>
    						<p class="hours">
                                Open Mon—Fri, 9am—5pm
    						</p>
						</div>
						<div class="connect">
							<div class="tel office">
								<span class="type">Office</span>
								<a href="tel:+12122799800" class="value">(212) 279-9800</a>
							</div>
							<div class="tel mobile">
								<span class="type">Mobile</span>
								<a href="tel:+19179029199" class="value">(917) 902-9199</a>
							</div>
							<div class="tel fax">
								<span class="type">Fax</span>
								<a href="tel:+18663962310" class="value">(866) 396-2310</a>
							</div>
							<div class="email-address">
								<span class="type">Email</span>
								<a href="mailto:info@robertprussocpa.com">info@robertprusso.com</a>
							</div>
						</div>
					</div>
					<div class="location-map">
						<a href="http://maps.google.com/maps?q=14+Penn+Plaza+New+York,+NY+10122&amp;ie=UTF8&amp;hq=&amp;hnear=14+Penn+Plaza,+New+York,+10001&amp;gl=us&amp;t=m&amp;vpsrc=6&amp;ll=40.749663,-73.993864&amp;spn=0.031211,0.054846&amp;z=14&amp;output=embed">
							<img src="<?php echo get_template_directory_uri(); ?>/img/map.png" alt="">
						</a>
                        <!-- <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?q=14+Penn+Plaza+New+York,+NY+10122&amp;ie=UTF8&amp;hq=&amp;hnear=14+Penn+Plaza,+New+York,+10001&amp;gl=us&amp;t=m&amp;vpsrc=6&amp;ll=40.749663,-73.993864&amp;spn=0.031211,0.054846&amp;z=14&amp;output=embed"></iframe> -->
                    </div>
				</div>
			
			</div>
		</header>
	<?php roots_header_after(); ?>