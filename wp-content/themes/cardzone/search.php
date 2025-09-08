<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package cardzone
 */

get_header();

$blog_column = is_active_sidebar( 'blog-sidebar' ) ? 8 : 12;

?>

<div class="rs-postbox-area postbox__area pt-120 pb-120">
	<div class="container custom-container-3">
		<div class="row">
			<div class="col-lg-<?php print esc_attr( $blog_column );?> blog-post-items">
				<div class="postbox__wrapper tp-blog__wrapper mb-50">
					<?php
						if ( have_posts() ):
					?>
					<div class="result-bar page-header d-none">
						<h1 class="page-title"><?php esc_html__( 'Search Results For:', 'cardzone' );?>
							<?php print get_search_query();?></h1>
					</div>
					<?php
						while ( have_posts() ): the_post();
							get_template_part( 'template-parts/content', 'search' );
						endwhile;
					?>
										<div class="rs-postbox-pagination">
							<?php cardzone_pagination( '<i class="material-symbols-outlined">chevron_left</i>', '<i class="material-symbols-outlined"> chevron_right</i>', '', ['class' => ''] );?>
						</div>
					<?php
						else:
							get_template_part( 'template-parts/content', 'none' );
						endif;
					?>
				</div>
			</div>
			<?php if ( is_active_sidebar( 'blog-sidebar' ) ): ?>
			<div class="col-lg-4">
				<div class="blog-sidebar__wrapper pl-30 rs-sidebar-wrapper">
					<?php get_sidebar();?>
				</div>
			</div>
			<?php endif;?>
		</div>
	</div>
</div>

<?php
get_footer();