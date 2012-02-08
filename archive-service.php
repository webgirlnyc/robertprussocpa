<?php get_header(); ?>
	<?php roots_content_before(); ?>
		<div id="content" class="<?php echo $roots_options['container_class']; ?>">	
		<?php roots_main_before(); ?>
			<div id="main" class="<?php echo $roots_options['main_class']; ?>" role="main">
				<div class="container">
					<h1>
						<?php post_type_archive_title(); ?>
					</h1>
					
					<?php
                        $args = array();
                        $args['post_type'] = 'service'; // set post type
                        $args['servicetype'] = 'individual-services'; // set tax type

                        query_posts($args); // run query
                        
                        $desc = term_description( '', get_query_var( 'taxonomy' ) );
                        
                        if ( have_posts() ) :
                        
                    ?>
                    <div id="<?php echo $args['servicetype']; ?>" class="service-type">
                        <header>
                            <h2>
                                Accounting Services for <?php single_term_title(); ?>
                            </h2>
                            <?php if($desc != '') : echo $desc; endif; ?>
                        </header>
                        <?php while ( have_posts() ) : the_post(); ?>
                        <div class="service">
                            <h3>
                                <?php the_title(); ?>
                            </h3>
                            <div class="entry">
                                <?php the_content(); ?>
                            </div>
                            <!-- <p>
                                                            <?php echo get_the_term_list( get_the_ID(), 'servicetype', "servicetype: " ) ?>
                                                        </p> -->
                        </div>
                        <?php endwhile; ?>
                    </div>

                    <?php 
                        
                        endif;
                    
                        $args['servicetype'] = 'business-services'; // set tax type
                        query_posts($args); // run query
                        $desc = term_description( '', get_query_var( 'taxonomy' ) );

                        if ( have_posts() ) :
                    
                    ?>
                    <div id="<?php echo $args['servicetype']; ?>" class="service-type">
                        <header>
                            <h2>
                                <?php single_term_title(); ?>
                            </h2>
                            <?php if($desc != '') : echo $desc; endif; ?>
                        </header>
                        <?php while ( have_posts() ) : the_post(); ?>
                        <div class="service">
                            <h3>
                                <?php the_title(); ?>
                            </h3>
                            <div class="entry">
                                <?php the_content(); ?>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
					<?php

                        endif;
                    
                        wp_reset_query();
                    
                    ?>
				</div>
			</div><!-- /#main -->
		<?php roots_main_after(); ?>
		<?php roots_sidebar_before(); ?>
			<aside id="sidebar" class="<?php echo $roots_options['sidebar_class']; ?>" role="complementary">
			<?php roots_sidebar_inside_before(); ?>
				<div class="container">
					<?php get_sidebar(); ?>
				</div>
			<?php roots_sidebar_inside_after(); ?>
			</aside><!-- /#sidebar -->
		<?php roots_sidebar_after(); ?>
		</div><!-- /#content -->
	<?php roots_content_after(); ?>
<?php get_footer(); ?>