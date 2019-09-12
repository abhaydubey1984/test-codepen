<?php 
/* Template Name: Home Page */
/** Home page structure and code */
    get_header();
?>
<div class='gen-wrapping'>
    <div class='gen-first-section'>
    <div class="container main">
        <div class='gen-section-one-left'>
            <?php echo do_shortcode( '[popular_category_latest]' );?>
        </div>
        <div class='gen-section-one-right'>        
            <?php echo do_shortcode( '[popular_category]' );?>
        </div>
    </div>
    </div>
	<div class='container twitter-section'>
		<?php echo do_shortcode( '[custom-twitter-feeds]'); ?>	
	</div>	
    <!-- Middle sections -->
    <div class='gen-second-section'>
        <div class="container">
            <?php echo do_shortcode( '[main_post_section]' ); ?> 
        </div>       
    </div>    
    <div class='gen-third-section'>
        <div class="container main">
            <div class="heading">
                <span class="main-heading">News</span>
            </div>            
            <div id="content" class="tab-content" role="tablist">
                <div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
                    <?php echo do_shortcode( '[news_category_post]' ); ?>                          
                </div>
            </div>        
        </div>
    </div>
	<div class='gen-four-section'>
            <div class="conference container">
                <div class="fusion-text">
                    <div class="heading">                        
                        <span class="main-heading">Most Popular</span>
                    </div>
                </div>
                <?php echo do_shortcode( '[most_popular]' );  ?>                                 
            </div>    
    </div>    
<?php 
get_footer();
?>