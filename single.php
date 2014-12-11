<?php get_header(); ?>

<style>input.form-white { width:95% !important; } h3{ line-height:normal; } .wpdate { margin-top:20px; }</style>

	<div id="thecontent">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="navigation"></div>
		<br/>
		<div class="post2" id="post-<?php the_ID(); ?>">
			<aside class="sm">
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
upcms_display_template_after();