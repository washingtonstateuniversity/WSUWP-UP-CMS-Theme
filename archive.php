<?php get_header(); ?>
<style>input.form-white { width:95% !important; } .post { margin: 16px 0 0; }</style>

<div id="content2" class="narrowcolumn">

	<?php

	if ( have_posts() ) :

		if ( is_category() ) {
			?><h2 class="pagetitle">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2><?php
		} elseif ( is_tag() ) {
			?><h2 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2><?php
		} elseif ( is_day() ) {
			?><h2 class="pagetitle">Archive for <?php the_time( 'F jS, Y' ); ?></h2><?php
		} elseif ( is_month() ) {
			?><h2 class="pagetitle">Archive for <?php the_time( 'F, Y' ); ?></h2><?php
		} elseif ( is_year() ) {
			?><h2 class="pagetitle">Archive for <?php the_time( 'Y' ); ?></h2><?php
		} elseif ( is_author() ) {
			?><h2 class="pagetitle">Author Archive</h2><?php
		} else {
			?><h2 class="pagetitle">Blog Archives</h2><?php
		}

		?>
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link( '&laquo; Older Entries' ) ?></div>
			<div class="alignright"><?php previous_posts_link( 'Newer Entries &raquo;' ) ?></div>
		</div>
		<?php

		while ( have_posts() ) : the_post(); ?>
			<div class="post">
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark"
													title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
				</h3>
				<aside>
					<?php get_sidebar(); ?>
				</aside>
				<small><?php the_time( 'l, F jS, Y' ) ?></small>

				<div class="entry">
					<?php the_content() ?>
				</div>

				<p class="postmetadata">Posted in <?php the_category( ', ' ) ?>
					| <?php edit_post_link( 'Edit', '', ' | ' ); ?>  <?php comments_popup_link( 'No Comments &#187;', '1 Comment &#187;', '% Comments &#187;' ); ?></p>

			</div>
		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link( '&laquo; Older Entries' ) ?></div>
			<div class="alignright"><?php previous_posts_link( 'Newer Entries &raquo;' ) ?></div>
		</div>
	<?php else : ?>
		<h2 class="center">Not Found</h2>
		<?php get_search_form(); ?>
	<?php endif; ?>

	</div>
<?php
wp_footer();
upcms_display_template_after();