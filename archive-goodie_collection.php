<?php
/**
 * Collection archive template.
 *
 * @package GoodieTheme
 */

get_header();

$selected_category = isset( $_GET['goodie_category'] ) ? sanitize_title( wp_unslash( $_GET['goodie_category'] ) ) : '';
$selected_sort     = isset( $_GET['goodie_sort'] ) ? sanitize_key( wp_unslash( $_GET['goodie_sort'] ) ) : 'latest';
$search_term       = isset( $_GET['s'] ) ? sanitize_text_field( wp_unslash( $_GET['s'] ) ) : '';
$categories        = get_terms(
	array(
		'taxonomy'   => 'goodie_category',
		'hide_empty' => false,
	)
);

$categories = is_wp_error( $categories ) ? array() : $categories;
?>
<section class="goodie-template">
	<div class="goodie-hero">
		<h1 class="goodie-title"><?php post_type_archive_title(); ?></h1>
		<p class="goodie-subtitle"><?php echo esc_html__( 'Browse sweet combinations made by the Goodie community.', 'goodie-collections' ); ?></p>
	</div>

	<section class="goodie-panel">
		<form class="goodie-filter-form" method="get" action="<?php echo esc_url( get_post_type_archive_link( 'goodie_collection' ) ); ?>">
			<div class="goodie-filter-grid">
				<p class="goodie-field">
					<label for="goodie-search"><?php echo esc_html__( 'Search', 'goodie-collections' ); ?></label>
					<input id="goodie-search" type="search" name="s" value="<?php echo esc_attr( $search_term ); ?>" placeholder="<?php echo esc_attr__( 'Search by collection name', 'goodie-collections' ); ?>" />
				</p>
				<p class="goodie-field">
					<label for="goodie-category"><?php echo esc_html__( 'Category', 'goodie-collections' ); ?></label>
					<select id="goodie-category" name="goodie_category">
						<option value=""><?php echo esc_html__( 'All categories', 'goodie-collections' ); ?></option>
						<?php foreach ( $categories as $category ) : ?>
							<option value="<?php echo esc_attr( $category->slug ); ?>" <?php selected( $selected_category, $category->slug ); ?>><?php echo esc_html( $category->name ); ?></option>
						<?php endforeach; ?>
					</select>
				</p>
				<p class="goodie-field">
					<label for="goodie-sort"><?php echo esc_html__( 'Sort by', 'goodie-collections' ); ?></label>
					<select id="goodie-sort" name="goodie_sort">
						<option value="latest" <?php selected( $selected_sort, 'latest' ); ?>><?php echo esc_html__( 'Latest created', 'goodie-collections' ); ?></option>
						<option value="alphabetical" <?php selected( $selected_sort, 'alphabetical' ); ?>><?php echo esc_html__( 'Alphabetical', 'goodie-collections' ); ?></option>
					</select>
				</p>
			</div>
			<div class="goodie-actions">
				<button type="submit"><?php echo esc_html__( 'Apply filters', 'goodie-collections' ); ?></button>
				<a class="goodie-button" href="<?php echo esc_url( get_post_type_archive_link( 'goodie_collection' ) ); ?>"><?php echo esc_html__( 'Reset', 'goodie-collections' ); ?></a>
			</div>
		</form>
	</section>

	<?php if ( have_posts() ) : ?>
		<div class="goodie-grid">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
				$product_count = count( goodie_collections_get_product_ids( get_the_ID() ) );
				$terms         = get_the_terms( get_the_ID(), 'goodie_category' );
				?>
				<a class="goodie-card" href="<?php the_permalink(); ?>">
					<p class="goodie-card__meta"><?php echo esc_html( get_the_date() ); ?></p>
					<h2 class="goodie-card__title"><?php the_title(); ?></h2>
					<p class="goodie-card__meta"><?php echo esc_html( sprintf( _n( '%d candy', '%d candies', $product_count, 'goodie-collections' ), $product_count ) ); ?></p>
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

		<div class="goodie-pagination">
			<?php echo wp_kses_post( paginate_links() ); ?>
		</div>
	<?php else : ?>
		<div class="goodie-empty">
			<h2><?php echo esc_html__( 'No collections found', 'goodie-collections' ); ?></h2>
			<p><?php echo esc_html__( 'Try another search term or create the first sweet mix.', 'goodie-collections' ); ?></p>
		</div>
	<?php endif; ?>
</section>
<?php
get_footer();
