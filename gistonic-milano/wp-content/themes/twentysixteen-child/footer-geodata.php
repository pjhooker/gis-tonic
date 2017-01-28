<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

		<div class="bs-docs-section clearfix">
			<div class="row">

				<footer id="colophon" class="col-sm-12" >

					<div class="well infobox" id="site-header-main">

						<div class="site-info">
							<?php
								/**
								 * Fires before the twentysixteen footer text for footer customization.
								 *
								 * @since Twenty Sixteen 1.0
								 */
								do_action( 'twentysixteen_credits' );
							?>
							<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
							<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentysixteen' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentysixteen' ), 'WordPress' ); ?></a>
						</div><!-- .site-info -->
					</div>
				</footer><!-- .site-footer -->

			</div><!-- .row -->
		</div><!-- .bs-docs-section -->
</div><!-- .container -->
<?php wp_footer(); ?>
</body>
</html>
