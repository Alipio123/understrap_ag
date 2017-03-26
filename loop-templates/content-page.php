<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */
$page_title_header_visibility = get_theme_mod( 'understrap_page_header_title_setting' );
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php if( $page_title_header_visibility =="page-header-title-enable" || empty($page_title_header_visibility) ){ ?>
		<header class="entry-header">

			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		</header><!-- .entry-header -->
	<?php } ?>

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
