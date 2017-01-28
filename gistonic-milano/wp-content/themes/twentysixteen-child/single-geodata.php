<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
 $postid = get_the_ID();
 $category = get_the_category();
 $catslug=$category[0]->slug;
 $catname=$category[0]->cat_name;
 $catlink=get_category_link( $category[0]->term_id);
get_header('geodata'); ?>

<div id="primary" class="col-sm-12">
  <main id="main" role="main" class="well infobox">

		<p style="color: #999;font-size:10px;">
      <span id="a" itemscope itemtype="http://data-vocabulary.org/Breadcrumb" itemref="b">
          <a href="http://gistonic-milano.1hi.it/" itemprop="url">
            <span itemprop="title">GIStonic Milano</span>
          </a> ›
      </span>
      <span id="b" itemscope itemtype="http://data-vocabulary.org/Breadcrumb" itemprop="child" itemref="c">
        <a href="http://gistonic-milano.1hi.it/geoblog-tonic/" itemprop="url">
          <span itemprop="title">GEOdata</span>
        </a> ›
      </span>
      <span id="c" itemscope itemtype="http://data-vocabulary.org/Breadcrumb" itemprop="child">
        <a href="<?php echo $catlink;?>" itemprop="url">
          <span itemprop="title"><?php echo $catname."";?></span>
        </a>
      </span>
    </p>

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

      $custommap_template=get_field('custom-map-template');

      if(!$custommap_template==NULL){$addtofile="-".$custommap_template;}
			// Include the single post content template.
			get_template_part( 'template-parts/content-geodata'.$addtofile, 'single' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			if ( is_singular( 'attachment' ) ) {
				// Parent post navigation.
				the_post_navigation( array(
					'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'twentysixteen' ),
				) );
			} elseif ( is_singular( 'post' ) ) {
				// Previous/next post navigation.
				the_post_navigation( array(
					'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentysixteen' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Next post:', 'twentysixteen' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentysixteen' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Previous post:', 'twentysixteen' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				) );
			}

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php //get_sidebar(); ?>
<?php get_footer('geodata'); ?>
