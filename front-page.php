<?php
/**
 * Front page template.
 *
 * @package GoodieTheme
 */

get_header();

$collection_form_url    = goodie_theme_get_collection_form_url();
$collection_archive_url = goodie_theme_get_collection_archive_url();
$collection_categories  = get_terms(
	array(
		'taxonomy'   => 'goodie_category',
		'hide_empty' => false,
		'number'     => 4,
	)
);

$collection_categories = is_wp_error( $collection_categories ) ? array() : $collection_categories;
$latest_collections    = new WP_Query(
	array(
		'post_type'              => 'goodie_collection',
		'post_status'            => 'publish',
		'posts_per_page'         => 3,
		'no_found_rows'          => true,
		'ignore_sticky_posts'    => true,
		'update_post_meta_cache' => true,
		'update_post_term_cache' => true,
	)
);
?>
<section class="goodie-home">
	<section class="goodie-home-hero">
		<div class="goodie-home-hero__content">
			<p class="goodie-home-eyebrow"><?php echo esc_html__( 'Candy collections made simple', 'goodie-collections' ); ?></p>
			<h1 class="goodie-home-title"><?php echo esc_html__( 'Build sweet mixes worth sharing.', 'goodie-collections' ); ?></h1>
			<p class="goodie-home-copy"><?php echo esc_html__( 'Create your own candy collection, pick a category, share the link with friends, and add the whole mix to the cart in one click.', 'goodie-collections' ); ?></p>
			<div class="goodie-home-actions">
				<a class="goodie-home-button" href="<?php echo esc_url( $collection_form_url ); ?>"><?php echo esc_html__( 'Create collection', 'goodie-collections' ); ?></a>
				<a class="goodie-home-button goodie-home-button--secondary" href="<?php echo esc_url( $collection_archive_url ); ?>"><?php echo esc_html__( 'Browse collections', 'goodie-collections' ); ?></a>
			</div>
		</div>
		<div class="goodie-home-hero__aside">
			<div class="goodie-home-stat">
				<strong><?php echo esc_html( wp_count_posts( 'goodie_collection' )->publish ); ?></strong>
				<span><?php echo esc_html__( 'live collections', 'goodie-collections' ); ?></span>
			</div>
			<div class="goodie-home-stat">
				<strong><?php echo esc_html( wp_count_terms( array( 'taxonomy' => 'goodie_category', 'hide_empty' => false ) ) ); ?></strong>
				<span><?php echo esc_html__( 'collection categories', 'goodie-collections' ); ?></span>
			</div>
			<div class="goodie-home-callout">
				<p><?php echo esc_html__( 'Mix gummies, chocolate, lakrits, or sour favorites into themed collections people can actually shop.', 'goodie-collections' ); ?></p>
			</div>
		</div>
	</section>

	<section class="goodie-home-section">
		<div class="goodie-home-section__head">
			<div>
				<p class="goodie-home-eyebrow"><?php echo esc_html__( 'Latest collections', 'goodie-collections' ); ?></p>
				<h2><?php echo esc_html__( 'Fresh from the Goodie community', 'goodie-collections' ); ?></h2>
			</div>
			<a class="goodie-home-text-link" href="<?php echo esc_url( $collection_archive_url ); ?>"><?php echo esc_html__( 'See all collections', 'goodie-collections' ); ?></a>
		</div>

		<?php if ( $latest_collections->have_posts() ) : ?>
			<div class="goodie-home-collection-grid">
				<?php while ( $latest_collections->have_posts() ) : $latest_collections->the_post(); ?>
					<?php
					$product_ids = function_exists( 'goodie_collections_get_product_ids' ) ? goodie_collections_get_product_ids( get_the_ID() ) : array();
					$terms       = get_the_terms( get_the_ID(), 'goodie_category' );
					$author_name = get_the_author();
					?>
					<a class="goodie-card goodie-home-card" href="<?php the_permalink(); ?>">
						<p class="goodie-card__meta"><?php echo esc_html( get_the_date() ); ?></p>
						<h3 class="goodie-card__title"><?php the_title(); ?></h3>
						<p class="goodie-card__meta"><?php echo esc_html( sprintf( __( 'Created by %s', 'goodie-collections' ), $author_name ) ); ?></p>
						<p class="goodie-card__meta"><?php echo esc_html( sprintf( _n( '%d candy', '%d candies', count( $product_ids ), 'goodie-collections' ), count( $product_ids ) ) ); ?></p>
						<?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
							<ul class="goodie-pill-list">
								<?php foreach ( $terms as $term ) : ?>
									<li class="goodie-pill"><?php echo esc_html( $term->name ); ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</a>
				<?php endwhile; ?>
			</div>
		<?php else : ?>
			<div class="goodie-empty">
				<h3><?php echo esc_html__( 'No collections yet', 'goodie-collections' ); ?></h3>
				<p><?php echo esc_html__( 'Start the first one and make the homepage feel properly sugary.', 'goodie-collections' ); ?></p>
			</div>
		<?php endif; ?>
	</section>

	<section class="goodie-home-section goodie-home-section--split">
		<div class="goodie-home-surface">
			<p class="goodie-home-eyebrow"><?php echo esc_html__( 'Browse by vibe', 'goodie-collections' ); ?></p>
			<h2><?php echo esc_html__( 'Jump into collection categories', 'goodie-collections' ); ?></h2>
			<?php if ( ! empty( $collection_categories ) ) : ?>
				<div class="goodie-home-category-grid">
					<?php foreach ( $collection_categories as $category ) : ?>
						<a class="goodie-home-category" href="<?php echo esc_url( add_query_arg( 'goodie_category', $category->slug, $collection_archive_url ) ); ?>">
							<span class="goodie-home-category__name"><?php echo esc_html( $category->name ); ?></span>
							<span class="goodie-home-category__meta"><?php echo esc_html( sprintf( _n( '%d collection', '%d collections', (int) $category->count, 'goodie-collections' ), (int) $category->count ) ); ?></span>
						</a>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<p><?php echo esc_html__( 'Add some collection categories in wp-admin to highlight them here.', 'goodie-collections' ); ?></p>
			<?php endif; ?>
		</div>

		<div class="goodie-home-surface">
			<p class="goodie-home-eyebrow"><?php echo esc_html__( 'How it works', 'goodie-collections' ); ?></p>
			<h2><?php echo esc_html__( 'From craving to cart in three steps', 'goodie-collections' ); ?></h2>
			<ol class="goodie-home-steps">
				<li>
					<strong><?php echo esc_html__( 'Pick your candies', 'goodie-collections' ); ?></strong>
					<span><?php echo esc_html__( 'Choose at least two products to create a proper mix.', 'goodie-collections' ); ?></span>
				</li>
				<li>
					<strong><?php echo esc_html__( 'Name and categorize it', 'goodie-collections' ); ?></strong>
					<span><?php echo esc_html__( 'Give the collection a name people want to click and a category that fits the mood.', 'goodie-collections' ); ?></span>
				</li>
				<li>
					<strong><?php echo esc_html__( 'Share or shop it instantly', 'goodie-collections' ); ?></strong>
					<span><?php echo esc_html__( 'Open the collection page, share the link, or send the whole set straight to the cart.', 'goodie-collections' ); ?></span>
				</li>
			</ol>
		</div>
	</section>

	<section class="goodie-home-cta">
		<div>
			<p class="goodie-home-eyebrow"><?php echo esc_html__( 'Ready to make one?', 'goodie-collections' ); ?></p>
			<h2><?php echo esc_html__( 'Build a new Goodie collection now.', 'goodie-collections' ); ?></h2>
			<p><?php echo esc_html__( 'Use the collection builder to create a mix, publish it, and let friends add the same candy combo to their own carts.', 'goodie-collections' ); ?></p>
		</div>
		<div class="goodie-home-actions">
			<a class="goodie-home-button" href="<?php echo esc_url( $collection_form_url ); ?>"><?php echo esc_html__( 'Open collection builder', 'goodie-collections' ); ?></a>
			<a class="goodie-home-button goodie-home-button--secondary" href="<?php echo esc_url( $collection_archive_url ); ?>"><?php echo esc_html__( 'Explore community picks', 'goodie-collections' ); ?></a>
		</div>
	</section>
</section>
<?php
wp_reset_postdata();
get_footer();