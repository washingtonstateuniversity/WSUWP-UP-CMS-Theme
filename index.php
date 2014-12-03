<?php
get_header();
?>
	<style>
    #dateicon
    {
    -moz-background-clip:border;
    -moz-background-inline-policy:continuous;
    -moz-background-origin:padding;
    color:#FFFFFF;
    float:left;
    height:42px;
    margin-top:2px;
    width:42px;
    }
    #dateicon h4
    {
    color:#67767D;
    font-family:"Lucida Sans";
    font-size:16px;
    font-weight:bold;
    line-height:1.5em;
    padding-left:0;
    text-align:center;
    }

    #dateicon h5
    {
    color:#FFFFFF;
    font-size:0.6em;
    font-weight:normal;
    line-height:1em;
    margin-top:1px;
    padding-left:0;
    text-align:center;
    text-transform:uppercase;
    }
    input.form-white
    {
    width:95% !important;
    }
  input.form-white
  {
  width:95% !important;
  }
  h3{line-height:normal;}
	.wpdate {margin-top:20px;}
  </style>
	<h1>Perspectives</h1>
	<div class="divider"></div>
	<aside class="sm">

      	<div class="right"><a href="http://feeds.feedburner.com/PresidentPerspectives"><img src="/beta/v1/images/ico-rss.png" alt="RSS feed" /></a></div>
        <h4>Recent posts</h4>

    <ul>
          <?php mdv_recent_posts(4,'<li>','</li>',true,0,false); ?>
      <?php the_tags(__('Tags: '), ', ', ''); ?>
      </ul><?php get_sidebar();?>
      </aside>

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

				<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<p class="wpdate"><em><?php the_date(); ?></em></p>

				<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>
        <div class="meta"><!--<?php _e("Filed under:"); ?> <?php the_category(',') ?> <?php the_tags(__('Tags: '), ', ', ' &#8212; '); ?>--></div>

		<?php endwhile; ?>


	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php include (TEMPLATEPATH . "/searchform.php"); ?>

	<?php endif; ?>

<!-- after -->
<?php
echo $after;
?>
