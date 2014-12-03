<?php get_header(); ?>

<style>input.form-white { width:95% !important; } h3{ line-height:normal; } .wpdate { margin-top:20px; }</style>

	<div id="thecontent">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="navigation"></div>
		<br/>
		<div class="post2" id="post-<?php the_ID(); ?>">
			<aside class="sm">
				<div class="right">
					<a href="http://feeds.feedburner.com/PresidentPerspectives"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/ico-rss.png' ); ?>" alt="RSS feed" /></a>
				</div>
				<h4>Recent posts </h4>
				<ul>
					<?php if ( function_exists( 'mdv_recent_posts' ) ) : mdv_recent_posts( 4, '<li>', '</li>', true, 0, false ); endif;?>
					<?php the_tags( __( '<h4>Tags: </h4>'), ', ', '' ); ?>
				</ul>
				<?php get_sidebar();?>
			</aside>
			<h3><?php the_title(); ?></h3>
			<p class="wpdate"><em><?php the_date(); ?></em></p>
			<div class="entry">
				<?php the_content( '<p class="serif">Read the rest of this entry &raquo;</p>' ); ?>
				<?php wp_link_pages( array( 'before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number' ) ); ?>
				<div class="meta"></div>
			</div>
		</div>
	<?php endwhile; else: ?>
		<p>Sorry, no posts matched your criteria.</p>
	<?php endif; ?>

	</div>

<?php

echo $after;