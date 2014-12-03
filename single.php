<style>
  input.form-white
  {
  width:95% !important;
  }
  h3{line-height:normal;}
  .wpdate {margin-top:20px;}
</style>
<?php 
include("setup.inc");
echo $before; ?>

	<div id="thecontent">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="navigation">
			<!--<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>-->
		</div>
		<br/>
		<div class="post2" id="post-<?php the_ID(); ?>">
      <aside class="sm">
        <div class="right">
          <a href="http://feeds.feedburner.com/PresidentPerspectives">
            <img src="/beta/v1/images/ico-rss.png" alt="RSS feed"/>
          </a>
        </div>
        <h4>Recent posts </h4>
        <ul>
          <?php mdv_recent_posts(4,'<li>','</li>',true,0,false);?>
          <?php the_tags(__('<h4>Tags: </h4>'), ', ', ''); ?>
        </ul>
        <?php get_sidebar();?>
      </aside>
			<h3><?php the_title(); ?></h3>
			<p class="wpdate"><em><?php the_date(); ?></em></p>
			<div class="entry">
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
        <div class="meta">
          <!--<?php _e("Filed under:"); ?> 33 <?php the_category(',') ?> &#8212; <?php the_tags(__('Tags: '), ', ', ' &#8212; '); ?>-->
        </div> 

				

			</div>
		</div>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>

	</div>

<?php 

echo $after;
?>
