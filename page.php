<?php
/**
 * Generic page template.
 *
 * @package GoodieTheme
 */

get_header();
?>
<section class="goodie-template">
	<?php while ( have_posts() ) : the_post(); ?>
		<article class="goodie-panel">
			<h1 class="goodie-title"><?php the_title(); ?></h1>
			<div class="goodie-content">
				<?php the_content(); ?>
			</div>
		</article>
	<?php endwhile; ?>
</section>
<?php
get_footer();
