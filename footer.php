	<?php roots_footer_before(); ?>
		<footer id="content-info" class="<?php global $roots_options; echo $roots_options['container_class']; ?>" role="contentinfo">
			<?php roots_footer_inside(); ?>
			<div class="container">
			    <nav id="nav-footer" role="navigation">
					<?php wp_nav_menu(array('theme_location' => 'primary_navigation')); ?>
				</nav>
				<?php dynamic_sidebar("Footer"); ?>
				<p class="copy"><small>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></small></p>
			</div>	
		</footer>
		<?php roots_footer_after(); ?>	
	</div><!-- /#wrap -->

    <?php wp_footer(); ?>
    <?php roots_footer(); ?>

    <!-- 
        
        Scripts
    
    -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/js/libs/jquery-1.6.2.min.js"><\/script>')</script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/plugins.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/scripts.js"></script>

	<!--[if lt IE 7]>
		<script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
		<script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->

</body>
</html>