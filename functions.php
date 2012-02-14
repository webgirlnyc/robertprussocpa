<?php

require_once get_template_directory() . '/inc/roots-activation.php'; 	// activation
require_once get_template_directory() . '/inc/roots-options.php'; 		// theme options
require_once get_template_directory() . '/inc/roots-cleanup.php'; 		// cleanup
require_once get_template_directory() . '/inc/roots-htaccess.php'; 		// rewrites for assets, h5bp htaccess
require_once get_template_directory() . '/inc/roots-hooks.php'; 		// hooks
require_once get_template_directory() . '/inc/roots-actions.php'; 		// actions
require_once get_template_directory() . '/inc/roots-widgets.php'; 		// widgets
require_once get_template_directory() . '/inc/roots-custom.php'; 		// custom functions

$roots_options = roots_get_theme_options();

// set the maximum 'Large' image width to the maximum grid width
if (!isset($content_width)) {
	global $roots_options;
	$roots_css_framework = $roots_options['css_framework'];
	switch ($roots_css_framework) {
	    case 'blueprint': 	$content_width = 950;	break;
	    case '960gs_12': 	$content_width = 940;	break;
	    case '960gs_16': 	$content_width = 940;	break;
	    case '960gs_24': 	$content_width = 940;	break;
	    case '1140': 		$content_width = 1140;	break;
	    case 'adapt':	 	$content_width = 940;	break;	    
	    default: 			$content_width = 950;	break;
	}
}

function roots_setup() {
	load_theme_textdomain('roots', get_template_directory() . '/lang');
	
	// tell the TinyMCE editor to use editor-style.css
	// if you have issues with getting the editor to show your changes then use the following line:
	// add_editor_style('editor-style.css?' . time());
	add_editor_style('editor-style.css');
	
	// http://codex.wordpress.org/Post_Thumbnails
	add_theme_support('post-thumbnails');
	// set_post_thumbnail_size(150, 150, false);
	
	// http://codex.wordpress.org/Post_Formats
	// add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));
	
	// http://codex.wordpress.org/Function_Reference/add_custom_image_header
	if (!defined('HEADER_TEXTCOLOR')) { define('HEADER_TEXTCOLOR', '');	}
	if (!defined('NO_HEADER_TEXT')) { define('NO_HEADER_TEXT', true); }	
	if (!defined('HEADER_IMAGE')) { define('HEADER_IMAGE', get_template_directory_uri() . '/img/logo.png'); }
	if (!defined('HEADER_IMAGE_WIDTH')) { define('HEADER_IMAGE_WIDTH', 300); }
	if (!defined('HEADER_IMAGE_HEIGHT')) { define('HEADER_IMAGE_HEIGHT', 75); }

	function roots_custom_image_header_site() { }
	function roots_custom_image_header_admin() { ?>
		<style type="text/css">
			.appearance_page_custom-header #headimg { min-height: 0; }
		</style>
	<?php }
	add_custom_image_header('roots_custom_image_header_site', 'roots_custom_image_header_admin');
		
	add_theme_support('menus');
	register_nav_menus(array(
		'primary_navigation' => __('Primary Navigation', 'roots'),
		'utility_navigation' => __('Utility Navigation', 'roots')
	));	
}

add_action('after_setup_theme', 'roots_setup');

// create widget areas: sidebar, footer
$sidebars = array('Sidebar', 'Footer');
foreach ($sidebars as $sidebar) {
	register_sidebar(array('name'=> $sidebar,
		'before_widget' => '<article id="%1$s" class="widget %2$s"><div class="container">',
		'after_widget' => '</div></article>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}


/* 



    ----- Robert Russo Site Specific Functions -----



*/

/*
    --- Extending ---
*/

// Body ID's
function get_body_id( $id = '' ) {
    global $wp_query;

    // Fallbacks
    if ( is_front_page() )  $id = 'front-page';
    if ( is_home() )        $id = 'home';
    if ( is_search() )      $id = 'search';
    if ( is_404() )         $id = 'error404';
        
    // If it's an Archive Page
    if ( is_archive() ) {
        if ( is_author() ) {
            $author = $wp_query->get_queried_object();
            $id = 'archive-author-' . sanitize_html_class( $author->user_nicename , $author->ID );
        } elseif ( is_category() ) {
            $cat = $wp_query->get_queried_object();
            $id = 'archive-category-' . sanitize_html_class( $cat->slug, $cat->cat_ID );
        } elseif ( is_date() ) {
                if ( is_day() ) {
                    $date = get_the_time('F jS Y');
                    $id = 'archive-day-' . str_replace(' ', '-', strtolower($date) );
                } elseif ( is_month() ) {
                    $date = get_the_time('F Y');
                    $id = 'date-' . str_replace(' ', '-', strtolower($date) );   
                } elseif ( is_year() ) {
                    $date = get_the_time('Y');
                    $id = 'date-' . strtolower($date);
                } else {
                    $id = 'archive-date';
                }
        } elseif ( is_tag() ) {
            $tags = $wp_query->get_queried_object();
            $id = 'archive-tag-' . sanitize_html_class( $tags->slug, $tags->term_id );
		} elseif ( is_tax() ) {
            $tags = $wp_query->get_queried_object();
            $id = sanitize_html_class( $tags->slug, $tags->term_id ).'-archive';
        } else {
            $id = 'archive';
        }
    }
    
    // If it's a Single Post
    if ( is_single() ) {
        if ( is_attachment() ) {
            $id = 'attachment-'.$wp_query->queried_object->post_name;
        } else {
            $id = 'single-'.$wp_query->queried_object->post_name;
        }
    }

    // If it's a Page
    if ( is_page() ) {
        $id = $wp_query->queried_object->post_name.'-page';
        if ('' == $id ) {
            $id = 'page';
        }
    }
    
    // If $id still doesn't have a value, attempt to assign it the Page's name
    if ('' == $id ) {
        $id = $wp_query->queried_object->post_name;
    }
    
    $id = preg_replace("#\s+#", " ", $id);
    $id = str_replace(' ', '-', strtolower($id) );
    
    // Let other plugins modify the function
    return apply_filters( 'body_id', $id );    

};
function body_id( $id = '' ) {
    if ( '' == $id ) {
        $id = get_body_id();
    }
    echo ( '' != $id ) ? 'id="'.$id. '"': '' ;
};

// Page Excerpts
add_action( 'init', 'rpr_add_excerpts_to_pages' );
function rpr_add_excerpts_to_pages() {
    add_post_type_support( 'page', 'excerpt' );
}

// Add category nicenames in body and post class
function category_id_class($classes) {
	global $post;
	foreach((get_the_category($post->ID)) as $category)
		$classes[] = $category->category_nicename;
	return $classes;
}
add_filter('post_class', 'category_id_class');
add_filter('body_class', 'category_id_class');


/*
    --- Custom Post Types & Taxonomies ---
*/

// Post Type: Services
add_action( 'init', 'create_services' );
function create_services() {
	$labels = array(
		'name' => _x('Services', 'post type general name'),
		'singular_name' => _x('Service', 'post type singular name'),
		'add_new' => _x('Add New', 'Service'),
		'add_new_item' => __('Add New Service'),
		'edit_item' => __('Edit Service'),
		'new_item' => __('New Service'),
		'view_item' => __('View Service'),
		'search_items' => __('Search Services'),
		'not_found' =>  __('No Services found'),
		'not_found_in_trash' => __('No Services found in Trash'),
		'parent_item_colon' => ''
	);

	$supports = array(
		'title',
		'editor',
		'custom-fields',
		'revisions',
		'excerpt',
		'thumbnail',
		'page-attributes'
	);

	register_post_type( 'service',
		array(
			'labels' => $labels,
			'menu_position' => 5,
			'public' => true,
			'supports' => $supports,
			'taxonomies' => array('post_tag'),
			'rewrite' => array('slug' => 'services'),
			'has_archive' => true
		)
	);
flush_rewrite_rules( false );
}

// Taxonomy: Service Types
add_action( 'init', 'create_servicetypes' );
function create_servicetypes() {
 $labels = array(
     'name' => _x( 'Service Types', 'taxonomy general name' ),
     'singular_name' => _x( 'Service Type', 'taxonomy singular name' ),
     'search_items' =>  __( 'Search Service Types' ),
     'all_items' => __( 'All Service Types' ),
     'parent_item' => __( 'Parent Service Type' ),
     'parent_item_colon' => __( 'Parent Service Type:' ),
     'edit_item' => __( 'Edit Service Type' ),
     'update_item' => __( 'Update Service Type' ),
     'add_new_item' => __( 'Add New Service Type' ),
     'new_item_name' => __( 'New Service Type Name' ),
 );

 register_taxonomy('servicetype','service',
     array(
         'hierarchical' => true,
         'labels' => $labels,
         'rewrite' => true,
         'show_ui' => true,
         'show_tagcloud' => true,
         'show_in_nav_menus' => true
     )
 );
flush_rewrite_rules( false );
}


/*

	----- Admin -----

*/ 

if (is_admin()) {

	// Adding custom taxonomies and terms to the post list for filtering
	add_filter( 'manage_posts_columns', 'ilc_cpt_columns' );
	add_action('manage_posts_custom_column', 'ilc_cpt_custom_column', 10, 2);

	function ilc_cpt_columns($defaults) {
	    $defaults['servicetype'] = 'Service Type';
	    return $defaults;
	}

	function ilc_cpt_custom_column($column_name, $post_id) {
	    $taxonomy = $column_name;
	    $post_type = get_post_type($post_id);
	    $terms = get_the_terms($post_id, $taxonomy);

	    if ( !empty($terms) ) {
	        foreach ( $terms as $term )
	            $post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
	        echo join( ', ', $post_terms );
	    }
	    else echo '<i>No terms.</i>';
	}	
	// end
	
	
	function todo_restrict_manage_posts() {
        global $typenow;
        $args=array( 'public' => true, '_builtin' => false ); 
        $post_types = get_post_types($args);
        if ( in_array($typenow, $post_types) ) {
        $filters = get_object_taxonomies($typenow);
            foreach ($filters as $tax_slug) {
                $tax_obj = get_taxonomy($tax_slug);
                wp_dropdown_categories(array(
                    'show_option_all' => __('Show All '.$tax_obj->label ),
                    'taxonomy' => $tax_slug,
                    'name' => $tax_obj->name,
                    'orderby' => 'term_order',
                    'selected' => $_GET[$tax_obj->query_var],
                    'hierarchical' => $tax_obj->hierarchical,
                    'show_count' => false,
                    'hide_empty' => true
                ));
            }
        }
    }
    function todo_convert_restrict($query) {
        global $pagenow;
        global $typenow;
        if ($pagenow=='edit.php') {
            $filters = get_object_taxonomies($typenow);
            foreach ($filters as $tax_slug) {
                $var = &$query->query_vars[$tax_slug];
                if ( isset($var) ) {
                    $term = get_term_by('id',$var,$tax_slug);
                    $var = $term->slug;
                }
            }
        }
    }
    add_action( 'restrict_manage_posts', 'todo_restrict_manage_posts' );
    add_filter('parse_query','todo_convert_restrict');

}





?>
