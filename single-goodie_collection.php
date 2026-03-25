<?php
/**
 * Single collection template.
 *
 * @package GoodieTheme
 */

get_header();
?>
<section class="goodie-template">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
		$products = goodie_collections_get_collection_products( get_the_ID() );
		$terms    = get_the_terms( get_the_ID(), 'goodie_category' );
		$author   = get_the_author();
		?>
		<div class="goodie-hero">
			<p class="goodie-meta"><?php echo esc_html( get_the_date() ); ?></p>
			<p class="goodie-meta"><?php echo esc_html( sprintf( __( 'Created by %s', 'goodie-collections' ), $author ) ); ?></p>
			<h1 class="goodie-title"><?php the_title(); ?></h1>
			<p class="goodie-subtitle"><?php echo esc_html__( 'Share this mix or add the full candy line-up to your cart in one step.', 'goodie-collections' ); ?></p>
			<?php if ( isset( $_GET['goodie_collection_created'] ) ) : ?>
				<div class="goodie-notice goodie-notice--success">
					<p><?php echo esc_html__( 'Your collection is live and ready to share.', 'goodie-collections' ); ?></p>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
				<ul class="goodie-pill-list">
					<?php foreach ( $terms as $term ) : ?>
						<li class="goodie-pill"><?php echo esc_html( $term->name ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>

		<div class="goodie-single-layout">
			<section class="goodie-single-products">
				<h2><?php echo esc_html__( 'Included candies', 'goodie-collections' ); ?></h2>
				<?php if ( ! empty( $products ) ) : ?>
					<div class="goodie-single-products__grid">
						<?php foreach ( $products as $product ) : ?>
							<article class="goodie-product-card">
								<div class="goodie-product-card__image">
									<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>">
										<?php echo $product->get_image( 'woocommerce_thumbnail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									</a>
								</div>
								<h3 class="goodie-product-card__title">
									<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>"><?php echo esc_html( $product->get_name() ); ?></a>
								</h3>
								<p class="goodie-product-card__price"><?php echo wp_kses_post( $product->get_price_html() ); ?></p>
							</article>
						<?php endforeach; ?>
					</div>
				<?php else : ?>
					<div class="goodie-empty">
						<p><?php echo esc_html__( 'This collection does not contain available products right now.', 'goodie-collections' ); ?></p>
					</div>
				<?php endif; ?>
			</section>

			<aside class="goodie-single-summary">
				<h2><?php echo esc_html__( 'Quick actions', 'goodie-collections' ); ?></h2>
				<p><?php echo esc_html__( 'Use the link below to share this collection with friends, or add every product to the cart at once.', 'goodie-collections' ); ?></p>
				<p><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_permalink() ); ?></a></p>
				<form class="goodie-add-to-cart-form" method="post" action="<?php echo esc_url( get_permalink() ); ?>">
					<?php wp_nonce_field( 'goodie_collection_add_to_cart_' . get_the_ID(), 'goodie_collection_cart_nonce' ); ?>
					<input type="hidden" name="goodie_collection_cart_action" value="add_collection_to_cart" />
					<input type="hidden" name="goodie_collection_id" value="<?php echo esc_attr( get_the_ID() ); ?>" />
					<button type="submit"><?php echo esc_html__( 'Add whole collection to cart', 'goodie-collections' ); ?></button>
				</form>
			</aside>
		</div>
	<?php endwhile; ?>
</section>
<?php
get_footer();
