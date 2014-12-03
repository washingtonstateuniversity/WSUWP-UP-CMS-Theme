<?php
get_header();
?>

	<div id="thecontent" class="narrowcolumn">
    <aside class="sm">

      <div class="right">
        <a href="http://feeds.feedburner.com/PresidentPerspectives">
          <img src="/beta/v1/images/ico-rss.png" alt="RSS feed" />
        </a>
      </div>
      <h4>Recent posts</h4>
      <ul>
        <?php mdv_recent_posts(4,'<li>','</li>',true,0,false); ?>
        <?php the_tags(__('Tags: '), ', ', ''); ?>
      </ul>
      <?php get_sidebar();?>
    </aside>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		<h3><?php the_title(); ?></h3>
			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			</div>
		</div>
		<?php endwhile; endif; ?>
	<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
	</div>

<?php
upcms_display_footer();