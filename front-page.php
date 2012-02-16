<?php get_header(); ?>
	<?php roots_content_before(); ?>
		<div id="content" class="<?php echo $roots_options['container_class']; ?>">	
		<?php roots_main_before(); ?>
			<div id="main" class="<?php echo $roots_options['main_class']; ?>" role="main">
				<div class="container">
					
					<!-- Tips -->
					<section id="tax-tips" class="home-page-section">
						<header>
							<h2>
							    <a href="http://twitter.com/robertprussocpa">
								    Tax Tips
								</a>
							</h2>
						</header>
                        <!-- Twitter Feed -->
                        <div class="flexslider">
                            <noscript>
                            	<a href="http://twitter.com/robertprussocpa">
								    Follow Roberts Tax Tips on Twitter
								</a>
                            </noscript>
                        </div>
					</section>
					
					<!-- Services -->
					<section id="services" class="home-page-section">
						<header>
							<h2>
							    <a href="#">
								    Services
								</a>
							</h2>
						</header>
						<?php
	                        $args = array();
	                        $args['post_type'] = 'service'; // set post type
	                        $args['servicetype'] = 'individual-services'; // set tax type

	                        query_posts($args); // run query

	                        $desc = term_description( '', get_query_var( 'taxonomy' ) );
                            $alink = get_term_link($args);
                            
	                        if ( have_posts() ) :

	                    ?>
	                    <div id="<?php echo $args['servicetype']; ?>" class="service-type">
	                        <h3>
	                            <a href="#">
	                                <?php single_term_title(); ?>
	                            </a>
	                        </h3>
	                        <ul class="service-list">
	                        <?php while ( have_posts() ) : the_post(); ?>
    	                        <li class="service">
    								<?php the_title(); ?>
    	                        </li>
	                        <?php endwhile; ?>
	                        </ul>
	                    </div>

	                    <?php 

	                        endif;

	                        $args['servicetype'] = 'business-services'; // set tax type
	                        query_posts($args); // run query
	                        $desc = term_description( '', get_query_var( 'taxonomy' ) );

	                        if ( have_posts() ) :

	                    ?>
	                    <div id="<?php echo $args['servicetype']; ?>" class="service-type">
	                        <h3>
	                            <a href="">
	                                <?php single_term_title(); ?>
	                            </a>
	                        </h3>
	                        <ul class="service-list">
	                        <?php while ( have_posts() ) : the_post(); ?>
    	                        <li class="service">
    								<?php the_title(); ?>
    	                        </li>
	                        <?php endwhile; ?>
	                        </ul>
	                    </div>
						<?php

	                        endif;

	                        wp_reset_query();

	                    ?>
					</section>
					
                    <!-- Resources -->
                    <section id="resources" class="home-page-section">
                        <header>
                            <h2>
                                <a href="#">
                                    Resources
                                </a>
                            </h2>
                        </header>
                        <ul class="resource-list">
            				<?php $resource_query = new WP_Query(array('post_type' => 'resource', 'posts_per_page' => -1)); ?>
            				<?php if ($resource_query->have_posts()) while ($resource_query->have_posts()) : $resource_query->the_post(); ?>
							<li><a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'robertrusso_resource_file', true)); ?>"><?php the_title() ?>.</a></li>
							<?php endwhile; ?>
                        </ul>
                    </section>
					
				</div>
			</div><!-- /#main -->
		<?php roots_main_after(); ?>
		</div><!-- /#content -->
	<?php roots_content_after(); ?>
<?php get_footer(); ?>