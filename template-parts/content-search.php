<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package AhnCommerce
 */

?>

<div class="col-lg-4 col-md-6 col-sm-12">
	<div class="blog__item">
		<div class="blog__item__pic">
			<?php if ( has_post_thumbnail() ) : ?>
				<img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
			<?php endif; ?>
		</div>
		<div class="blog__item__text">
			<ul>
				<li><i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo esc_html( get_the_date() ); ?></li>
				<li><i class="fa fa-comment-o" aria-hidden="true"></i> <?php echo esc_html( get_comments_number() ); ?></li>
			</ul>
			<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
			<p><?php echo esc_html( get_the_excerpt() ); ?></p>
			<a href="<?php the_permalink(); ?>" class="blog__btn">
				<?php esc_html_e( 'READ MORE', 'ahncommerce' ); ?>
				<span class="arrow_right" aria-hidden="true"></span>
			</a>
		</div>
	</div>
</div>
