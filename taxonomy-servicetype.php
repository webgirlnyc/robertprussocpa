<?php get_header(); ?>
	<?php roots_content_before(); ?>
		<div id="content" class="<?php echo $roots_options['container_class']; ?>">	
		<?php roots_main_before(); ?>
			<div id="main" class="<?php echo $roots_options['main_class']; ?>" role="main">
				<div class="container">
				    <?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
				    <header>
    					<h1>
    						<?php echo $term->name; ?> Services
    					</h1>
                        <?php 
							$desc = term_description( '', get_query_var( 'taxonomy' ) );
							if($desc != '') : echo $desc; endif; 
						?>
                    </header>
					<?php
                        $args = array();
                        $args['post_type'] = 'service'; // set post type
                        $args['servicetype'] = $term->slug; // set tax type

                        query_posts($args); // run query
                        
                        $desc = term_description( '', get_query_var( 'taxonomy' ) );
                        
                        if ( have_posts() ) :
                        
                    ?>
                    <div id="individual-services" class="service-type">
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