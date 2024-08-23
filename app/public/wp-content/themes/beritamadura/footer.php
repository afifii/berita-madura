<?php wp_footer(); ?>

<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Your_Theme_Name
 */

?>

		</div><!-- #content -->

		<footer id="colophon" class="site-footer bg-dark text-light py-4">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
							<?php dynamic_sidebar( 'footer-1' ); ?>
						<?php endif; ?>
					</div>
					<div class="col-md-4">
						<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
							<?php dynamic_sidebar( 'footer-2' ); ?>
						<?php endif; ?>
					</div>
					<div class="col-md-4">
						<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
							<?php dynamic_sidebar( 'footer-3' ); ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-12 text-center">
						<p>&copy; <?php echo date('Y'); ?> Berita Madura.</p>
					</div>
				</div>
			</div>
		</footer><!-- #colophon -->

	</div><!-- #page -->

	<?php wp_footer(); ?>

	</body>
</html>