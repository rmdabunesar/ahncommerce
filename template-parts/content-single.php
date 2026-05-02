<?php
/**
 * Template part for displaying single post content.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AhnCommerce
 */

?>

<div class="blog__details__text">
	<?php if ( has_post_thumbnail() ) : ?>
		<img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
	<?php endif; ?>

	<h3><?php the_title(); ?></h3>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</div>

<div class="blog__details__content">
	<div class="row">
		<div class="col-lg-6">
			<div class="blog__details__author">
				<div class="blog__details__author__pic">
					<?php
					// Display the author avatar (80px) or fall back to the placeholder avatar image.
					$ahncommerce_author_id = get_the_author_meta( 'ID' );
					echo get_avatar( $ahncommerce_author_id, 80 );
					?>
				</div>
				<div class="blog__details__author__text">
					<h6><?php the_author(); ?></h6>
					<?php
					$ahncommerce_user  = get_userdata( $ahncommerce_author_id );
					$ahncommerce_roles = $ahncommerce_user ? $ahncommerce_user->roles : array();
					if ( ! empty( $ahncommerce_roles ) ) :
						?>
						<span><?php echo esc_html( implode( ', ', $ahncommerce_roles ) ); ?></span>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="blog__details__widget">
				<ul>
					<li>
						<span><?php esc_html_e( 'Categories:', 'ahncommerce' ); ?></span>
						<?php the_category( ', ' ); ?>
					</li>
					<li>
						<span><?php esc_html_e( 'Tags:', 'ahncommerce' ); ?></span>
						<?php the_tags( '', ', ', '' ); ?>
					</li>
				</ul>

				<div class="blog__details__social">
					<?php
					$ahncommerce_social_platforms = array( 'facebook', 'twitter', 'linkedin', 'instagram' );
					foreach ( $ahncommerce_social_platforms as $ahncommerce_platform ) :
						$ahncommerce_url = get_theme_mod( 'set_' . $ahncommerce_platform . '_link', '' );
						if ( ! empty( $ahncommerce_url ) ) :
							?>
							<a href="<?php echo esc_url( $ahncommerce_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( ucfirst( $ahncommerce_platform ) ); ?>">
								<i class="fa fa-<?php echo esc_attr( $ahncommerce_platform ); ?>" aria-hidden="true"></i>
							</a>
							<?php
						endif;
					endforeach;
					?>
				</div>
			</div>
		</div>
	</div>
</div>
