<?php

/* Loaded Bootstrap Script and css */
function wmpudev_enqueue_icon_stylesheet() {
	wp_register_style( 'fontawesome', 'http:////maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'fontawesome');
}
add_action( 'wp_enqueue_scripts', 'wmpudev_enqueue_icon_stylesheet' );


function wmpudev_enqueue_bootstrap_stylesheet() {
	wp_register_style( 'bootstrap4', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap4');
	
}
add_action( 'wp_enqueue_scripts', 'wmpudev_enqueue_bootstrap_stylesheet' );

function gen_scripts_loaded() {
    wp_enqueue_script(
        'custom-script',
		get_stylesheet_directory_uri() . '/js/bootstrap.min.js',		
        array( 'jquery' )
    );
}
add_action( 'wp_enqueue_scripts', 'gen_scripts_loaded' );

/* Register Header Menu */
register_nav_menus(
	array(
		'header' => __( 'Header Main Menu', 'twentynineteen' ),		
	)
);
/* Register Header-top left Menu */
register_nav_menus(
	array(
		'header-top' => __( 'Header Top Main Menu', 'twentynineteen' ),		
	)
);
/* Register Footer Bottom Menu */
register_nav_menus(
	array(
		'footer-bottom' => __( 'Footer Bottom Menu', 'twentynineteen' ),		
	)
);

?>
<?php
/* Create shortcode for First Latest Post Popular Category Type */
add_shortcode('popular_category_latest', 'popular_posts_latest');
function popular_posts_latest() {
	ob_start();
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 1,
		'order' => 'DESC',
		'category_name'=>'research',
	  );
	  $myposts = get_posts( $args );
	  
	  foreach ($myposts as $key => $allposts){
		  $category_name = get_the_category($allposts->ID)[0]->name;

		  if ( has_post_thumbnail($allposts->ID) ) {			  	
				$img_url = get_the_post_thumbnail_url($allposts->ID,'full'); 				
			}else{						
				$img_url = get_stylesheet_directory_uri().'/images/no-image.png';				
			}		
		  ?>
		  	<div class="popular-article-content">
				<a href="<?php echo $allposts->guid; ?>" title='<?php echo $allposts->post_title;?>'><img class="popular-article-img" src="<?php echo $img_url;?>" /></a>
			</div>
			<div class="popular-article-content-details">
				<div class="popular-article-heading">
					<a href="<?php echo $allposts->guid; ?>" title='<?php echo $allposts->post_title;?>'><?php echo $allposts->post_title;?></a>
					</div>
				<div class="popular-article-details">
					<?php echo wp_trim_words( $allposts->post_content, 40, '...' );	?>
				</div>
				<div class="popular-article-details-author">
					<em><?php echo "-By " .get_the_author_meta('display_name', $allposts->post_author); ?></em>
				</div>
			</div>
		  <?php
	  }
	  return ob_get_clean();
}

/* Create shortcode for First Sidebar Post Popular Category Type */
add_shortcode('popular_category', 'popular_posts');
function popular_posts() {
	ob_start();
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 2,
		'category_name'=>'research',
		'order' => 'desc',
		'offset' => 1,
	  );
	  $myposts = get_posts( $args );
	  
	  foreach ($myposts as $key => $allposts){
		  $category_name = get_the_category($allposts->ID)[0]->name;			
		  if ( has_post_thumbnail($allposts->ID) ) {			  	
				  $img_url = get_the_post_thumbnail_url($allposts->ID,'full'); 				
		  }else{						
				$img_url = get_stylesheet_directory_uri().'/images/no-image.png';				
		  }		  
		  ?>
		  	<div class="popular-article-content">
			  	<a href="<?php echo $allposts->guid; ?>" title='<?php echo $allposts->post_title;?>'><img class="popular-article-img" src="<?php echo $img_url;?>" /></a>				
				<div class="popular-article-heading">
					<a href="<?php echo $allposts->guid; ?>" title='<?php echo $allposts->post_title;?>'><?php echo $allposts->post_title;?></a>
					<span class="popular-article-tag"><?php echo $category_name; ?></span>
				</div>
			</div>
			<div class="popular-article-details">
				<?php echo wp_trim_words( $allposts->post_content, 40, '...' );	?>
			</div>
			<div class="popular-article-details-author">
				<em><?php echo "-By " .get_the_author_meta('display_name', $allposts->post_author); ?></em>
			</div>
		  <?php
	  }
	  return ob_get_clean();
}

/* Create shortcode for Post Recent Category Type */
add_shortcode('main_post_section', 'recent_posts_display');
function recent_posts_display() {
	ob_start();
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 3,
		'category_name'=>'science',
	  );
	  $myrecentposts = get_posts( $args );
	  
	  foreach ($myrecentposts as $key => $recent_posts){
		if ( has_post_thumbnail($recent_posts->ID) ) {			  	
			$img_url = get_the_post_thumbnail_url($recent_posts->ID,'full'); 				
		}else{						
			$img_url = get_stylesheet_directory_uri().'/images/no-image.png';				
		}		
		
		
		if($key == 0 || $key == 2){
			?>
				<div class="article-list">
					<div class="article-list-img">
						<a href="<?php echo $recent_posts->guid; ?>" title='<?php echo $recent_posts->post_title;?>'><img src="<?php echo $img_url;?>" /></a>
					</div>
					<div class="article-list-content">
						<h4 class="article-list-content-heading"><a href="<?php echo $recent_posts->guid; ?>" title='<?php echo $recent_posts->post_title;?>'><?php echo $recent_posts->post_title;?></a></h4>
						<em>- By <?php echo get_the_author_meta('display_name', $recent_posts->post_author);?> | <?php echo get_the_date(); ?></em>	
						<div class="article-list-content-details">							
							<?php echo wp_trim_words( $recent_posts->post_content, 40, '...' );	?>
						</div>
					</div>
				</div>	
			<?php
		}
		if($key == 1){
			?>
				<div class="article-list">
					<div class="article-list-content">
						<h4 class="article-list-content-heading"><a href="<?php echo $recent_posts->guid; ?>" title='<?php echo $recent_posts->post_title;?>'><?php echo $recent_posts->post_title;?></a></h4>
						<em>- By <?php echo get_the_author_meta('display_name', $recent_posts->post_author);?> | <?php echo get_the_date(); ?></em>	
						
						<div class="article-list-content-details">
							<?php echo wp_trim_words( $recent_posts->post_content, 40, '...' );	?>
						</div>
					</div>
					<div class="article-list-img">
						<a href="<?php echo $recent_posts->guid; ?>" title='<?php echo $recent_posts->post_title;?>'><img src="<?php echo $img_url;?>" /></a>
					</div>
				</div>	
			<?php
		}
		
	  }
	return ob_get_clean();
}

/* Create shortcode for Post Recent Footer Bottom last sections */
add_shortcode('footer_recent_post', 'footer_recent_posts_display');
function footer_recent_posts_display() {
	ob_start();
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 3,
		'category_name'=>'research',
	  );
	  $myrecentposts = get_posts( $args );	  
	  foreach ($myrecentposts as $key => $recent_posts){
		if ( has_post_thumbnail($recent_posts->ID) ) {			  	
			$img_url = get_the_post_thumbnail_url($recent_posts->ID,'thumbnail'); 						
		}else{						
			$img_url = get_stylesheet_directory_uri().'/images/no-image.png';				
		}		
			?>
				<li class="list-unstyled latest-post">
					<a class="latest-post-img" href="<?php echo $recent_posts->guid ?>" >
						<img src="<?php echo $img_url;?>" />
					</a>
					<div class="latest-post-detail">
						<h3 class="latest-post-title">
							<a href="<?php echo $recent_posts->guid ?>" title="<?php echo $recent_posts->post_title;?>"><?php echo $recent_posts->post_title;?></a>
						</h3>
						<time class="latest-post-time published"><?php echo "- By ". get_the_author_meta('display_name', $recent_posts->post_author) ." | ". date('F j, Y', strtotime(get_the_date())) ?></time>
					</div>
				</li>
		<?php
		}	  
	return ob_get_clean();
}

/* Create shortcode for Middle section Post News Category Type */
add_shortcode('news_category_post', 'news_posts');
function news_posts() {
	ob_start();
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 3,
		'category_name'=>'news',
	  );
	  $myposts = get_posts( $args );
	  
	  foreach ($myposts as $key => $allposts){
		  $category_name = get_the_category($allposts->ID)[0]->name;			
		  if ( has_post_thumbnail($allposts->ID) ) {			  	
				  $img_url = get_the_post_thumbnail_url($allposts->ID,'full'); 				
		  }else{						
				$img_url = get_stylesheet_directory_uri().'/images/no-image.png';				
		  }		  
		  ?>
		  	<div class="our-news">
				<div class="our-news-card">
						<div class="our-news-img-card">
							<a href="<?php echo $allposts->guid; ?>" title='<?php echo $allposts->post_title;?>'><img src='<?php echo $img_url;?>' /></a>		    	
						</div>
						<div class="our-news-content">
							<span class="our-news-content-date"><?php echo date('F j, Y', strtotime($allposts->post_date));?></span>
							<h4 class="our-news-content-heading">
								<a href="<?php echo $allposts->guid; ?>" title='<?php echo $allposts->post_title;?>'><?php echo wp_trim_words( $allposts->post_title, 7, '...' ); ?></a>
		  					</h4>
							<p class="our-news-content-details">
								<?php echo wp_trim_words( $allposts->post_content, 20, '...' ); ?>
							</p>
						</div>
					<div class="extra">
					<hr class="hr">					
					<p class="our-news-content-btn-learn">
						<a href="<?php echo $allposts->guid; ?>">Learn More                             
							<span class="our-news-content-btn-learn-icon">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/learn-more-arrow.png">
							</span>
						</a>
					</p>
					</div>
				</div>
			</div>	
		  <?php
	  }
	  return ob_get_clean();
}
/* Create shortcode for Middle section Post News Category Type */
add_shortcode('science_category_post', 'science_posts');
function science_posts() {
	ob_start();
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 3,
		'category_name'=>'science',
	  );
	  $myposts = get_posts( $args );
	  
	  foreach ($myposts as $key => $allposts){
		  $category_name = get_the_category($allposts->ID)[0]->name;			
		  if ( has_post_thumbnail($allposts->ID) ) {			  	
				  $img_url = get_the_post_thumbnail_url($allposts->ID,'full'); 				
		  }else{						
				$img_url = get_stylesheet_directory_uri().'/images/no-image.png';				
		  }		  
		  
		  ?>
		  	<div class="our-news">
				<div class="our-news-card">
						<div class="our-news-img-card">
							<a href="<?php echo $allposts->guid; ?>" title='<?php echo $allposts->post_title;?>'><img src='<?php echo $img_url;?>' /></a>
						</div>
						<div class="our-news-content">
							<span class="our-news-content-date"><?php echo date('F j, Y', strtotime($allposts->post_date));?></span>
							<h4 class="our-news-content-heading">
								<a href="<?php echo $allposts->guid; ?>" title='<?php echo $allposts->post_title;?>'><?php echo wp_trim_words( $allposts->post_title, 7, '...' ); ?></a>
		  					</h4>
							<p class="our-news-content-details">
								<?php echo wp_trim_words( $allposts->post_content, 20, '...' ); ?>
							</p>
						</div>
					<div class="extra">
					<hr class="hr">					
					<p class="our-news-content-btn-learn">
						<a href="<?php echo $allposts->guid; ?>">Learn More                             
							<span class="our-news-content-btn-learn-icon">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/learn-more-arrow.png">
							</span>
						</a>
					</p>
					</div>
				</div>
			</div>	
		  <?php
	  }
	  return ob_get_clean();
}

/* Create shortcode for recent Post Recent for about page sidebar sections */
add_shortcode('page_sidebar_recent_post', 'page_sidebar_recent_post_display');
function page_sidebar_recent_post_display() {
	ob_start();
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 5,		
	  );
	  $myrecentposts = get_posts( $args );	  
	  foreach ($myrecentposts as $key => $recent_posts){
		if ( has_post_thumbnail($recent_posts->ID) ) {			  	
			$img_url = get_the_post_thumbnail_url($recent_posts->ID,'medium'); 						
		}else{						
			$img_url = get_stylesheet_directory_uri().'/images/no-image.png';				
		}		
			?>
				<li class="list-unstyled latest-post">
					<a class="latest-post-img" href="<?php echo $recent_posts->guid ?>" >
						<img src="<?php echo $img_url;?>" />
					</a>
					<div class="latest-post-detail">
						<h3 class="latest-post-title">
							<a href="<?php echo $recent_posts->guid ?>" title="<?php echo $recent_posts->post_title;?>"><?php echo $recent_posts->post_title;?></a>
						</h3>						
					</div>
				</li>
		<?php
		}	  
	return ob_get_clean();
}



// Our custom post type function
function create_posttype() {
 
    register_post_type( 'news',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'News' ),
				'singular_name' => __( 'News' )
            ),
            'public' => true,
            'has_archive' => true,
			'rewrite' => array('slug' => 'news'),
			'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'),
			
		)		
	);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );


function themes_taxonomy() {  
    register_taxonomy(  
        'news-category',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces). 
        'news',        //post type name
        array(  
            'hierarchical' => true,  
            'label' => 'Category',  //Display name
            'query_var' => true,
            'rewrite' => array(
                'slug' => 'news', // This controls the base slug that will display before each term
                'with_front' => false // Don't display the category base before 
            )
        )  
    );  
}  
add_action( 'init', 'themes_taxonomy');


function wpb_widgets_init() {
 
    register_sidebar( array(
        'name' =>__( 'Footer First Section', 'wpb'),
        'id' => 'footer-first-section',
        'description' => __( 'Add Footer Section', 'wpb' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    }
 
add_action( 'widgets_init', 'wpb_widgets_init' );

function wpb_widgets_copyright() {
 
    register_sidebar( array(
        'name' =>__( 'Copy Right section', 'wpb'),
        'id' => 'copy-right',
        'description' => __( 'Copy Right Section', 'wpb' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    }
 
add_action( 'widgets_init', 'wpb_widgets_copyright' );

function wpb_header_email() {
 
    register_sidebar( array(
        'name' =>__( 'Header Email Section', 'wpb'),
        'id' => 'header-top-email',
        'description' => __( 'Header Email Section', 'wpb' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    }
 
add_action( 'widgets_init', 'wpb_header_email' );

function wpb_top_ad_banner() {
 
    register_sidebar( array(
        'name' =>__( 'Top Header Ad Section', 'wpb'),
        'id' => 'top-header-ad',
        'description' => __( 'Top Header Ad Section', 'wpb' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    }
 
add_action( 'widgets_init', 'wpb_top_ad_banner' );


function wpb_page_sidebar_init() {
 
    register_sidebar( array(
        'name' =>__( 'Page sidebar section', 'wpb'),
        'id' => 'page-sidebar-section',
        'description' => __( 'Add Page sidebar section', 'wpb' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    }
 
add_action( 'widgets_init', 'wpb_page_sidebar_init' );


/* Create shortcode for First Latest Post Popular Category Type */
add_shortcode('most_popular', 'most_popular_latest');
function most_popular_latest() {
	ob_start();
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 5,
		'order' => 'DESC',
		'category_name'=>'most-popular',
	  );
	  $myposts = get_posts( $args );
	  $popplus = 1;
	  foreach ($myposts as $key => $allposts){
		  $category_name = get_the_category($allposts->ID)[0]->name;

		  if ( has_post_thumbnail($allposts->ID) ) {			  	
				$img_url = get_the_post_thumbnail_url($allposts->ID,'full'); 				
			}else{						
				$img_url = get_stylesheet_directory_uri().'/images/no-image.png';				
			}		
		  ?>
		  	<div class="fusion-text">
                    <div class="conference-content">
                        <div class="conference-content-count">
                            <span class="conference-count"><?php echo $popplus; ?></span>
                        </div>                    
                        <div class="conference-content-details">
                            <span class="conference-content-heading"><a href="<?php echo $allposts->guid; ?>" title='<?php echo $allposts->post_title;?>'><?php echo $allposts->post_title;?></a></span>
                            <span class="conference-content-date"><em><?php echo "-By " .get_the_author_meta('display_name', $allposts->post_author); ?></em></span>
                        </div>
                    </div>
            </div>
		  <?php $popplus++;
	  }
	  return ob_get_clean();
}

add_action( 'widgets_init', 'wpb_ad_banner_single' );

function wpb_ad_banner_single() {
 
    register_sidebar( array(
        'name' =>__( 'Single page Ad Section', 'wpb'),
        'id' => 'ad_banner_single',
        'description' => __( 'Single page Ad Section', 'wpb' ),
        'before_widget' => '<p id="%1$s" class="widget %2$s">',
        'after_widget' => '</p>',
    ) );
    }
 
add_action( 'widgets_init', 'wpb_ad_banner_single' );