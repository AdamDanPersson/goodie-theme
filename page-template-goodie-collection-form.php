<?php
/**
 * Template Name: Goodie Collection Form
 * Template Post Type: page
 *
 * @package GoodieTheme
 */

get_header();
?>
<section class="goodie-template">
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="goodie-hero">
			<h1 class="goodie-title"><?php the_title(); ?></h1>
			<p class="goodie-subtitle"><?php echo esc_html__( 'Build a candy collection, choose a category, and share it with other sweet-toothed shoppers.', 'goodie-collections' ); ?></p>
		</div>
		<section class="goodie-panel">
			<div class="goodie-content">
				<?php the_content(); ?>
			</div>
			<?php echo do_shortcode( '[goodie_collection_form]' ); ?>
		</section>
	<?php endwhile; ?>
</section>
<?php
get_footer();
