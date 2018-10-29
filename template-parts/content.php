<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lamface
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>		

	<?php if ( is_home() ): ?>
	<?php lamface_post_thumbnail(); ?>
	<?php endif; ?>

	<?php if ( !is_home() ): ?>
	<div class="entry-top-share">
		<i class="fa fa-share-alt-square"></i>
      <span class="share-activator-label share-activator caption">Share</span>
      <div class="os_social-head-w"><div class="os_social"><a class="os_social_twitter_share" href="http://twitter.com/share?url=http://pluto.pinsupreme.com/orange-carrot-smoothie/&amp;text=Orange+carrot+smoothie" target="_blank"><img src="http://pluto.pinsupreme.com/wp-content/themes/pluto-by-osetin/assets/images/socialicons/twitter.png" title="Twitter" class="os_social" alt="Tweet about this on Twitter"></a><a class="os_social_pinterest_share" data-pin-custom="true" target="_blank" data-pin-log="button_pinit" data-pin-href="https://www.pinterest.com/pin/create/button?guid=FoqYcevXMRvx-1&amp;url=http%3A%2F%2Fpluto.pinsupreme.com%2Forange-carrot-smoothie%2F&amp;media=http%3A%2F%2Fpluto.pinsupreme.com%2Fwp-content%2Fuploads%2F2014%2F05%2FAdobeStock_103332683.jpg&amp;description=Orange%2Bcarrot%2Bsmoothie"><img src="http://pluto.pinsupreme.com/wp-content/themes/pluto-by-osetin/assets/images/socialicons/pinterest.png" title="Pinterest" class="os_social" alt="Pin on Pinterest"></a><a class="os_social_linkedin_share" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://pluto.pinsupreme.com/orange-carrot-smoothie/" target="_blank"><img src="http://pluto.pinsupreme.com/wp-content/themes/pluto-by-osetin/assets/images/socialicons/linkedin.png" title="Linkedin" class="os_social" alt="Share on LinkedIn"></a><a class="os_social_google_share" href="https://plus.google.com/share?url=http://pluto.pinsupreme.com/orange-carrot-smoothie/" target="_blank"><img src="http://pluto.pinsupreme.com/wp-content/themes/pluto-by-osetin/assets/images/socialicons/google.png" title="Google+" class="os_social" alt="Share on Google+"></a><a class="os_social_email_share" href="mailto:?Subject=Orange+carrot+smoothie&amp;Body=%20http://pluto.pinsupreme.com/orange-carrot-smoothie/"><img src="http://pluto.pinsupreme.com/wp-content/themes/pluto-by-osetin/assets/images/socialicons/email.png" title="Email" class="os_social" alt="Email this to someone"></a><a class="os_social_facebook_share" href="http://www.facebook.com/sharer.php?u=http://pluto.pinsupreme.com/orange-carrot-smoothie/" target="_blank"><img src="http://pluto.pinsupreme.com/wp-content/themes/pluto-by-osetin/assets/images/socialicons/facebook.png" title="Facebook" class="os_social" alt="Share on Facebook"></a><a class="os_social_vk_share" href="http://vkontakte.ru/share.php?url=http://pluto.pinsupreme.com/orange-carrot-smoothie/" target="_blank"><img src="http://pluto.pinsupreme.com/wp-content/themes/pluto-by-osetin/assets/images/socialicons/vkontakte.png" title="Vkontakte" class="os_social" alt="Share on Vkontakte"></a><a class="os_social_ok_share" href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&amp;st._surl=http://pluto.pinsupreme.com/orange-carrot-smoothie/" target="_blank"><img src="http://pluto.pinsupreme.com/wp-content/themes/pluto-by-osetin/assets/images/socialicons/ok.png" title="Odnoklassniki" class="os_social" alt="Share on Odnoklassniki"></a></div></div>
	</div>
	<?php endif; ?>
	
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>

		<?php if ( 'post' === get_post_type() && is_singular() ) :
			?>
			<div class="entry-meta">
				<?php
				lamface_posted_on();
				lamface_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( !is_home() ): ?>
	<?php lamface_post_thumbnail(); ?>
	<?php endif; ?>

	<div class="entry-content">
		<?php

		if ( is_home() ) {
			echo( wp_trim_words( get_the_excerpt(), 20 ) );
		}
		else {
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'lamface' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lamface' ),
				'after'  => '</div>',
			) );
		}

		?>		

	</div><!-- .entry-content -->

	<?php if ( is_home() ) :  ?>
		<div class="read-more-link"><a href="<?php the_permalink() ?>">Đọc tiếp</a></div>
	<?php endif; ?>

	<div class="entry-footer">
		<?php if ( is_home() ) : 
			echo( '<span class="categories">' . get_the_category_list( esc_html__( ', ', 'lamface' ) ) . '</span>' );
			lamface_posted_on( false );
		else:
			lamface_entry_footer(); 
		endif; ?>
	</div><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
