<style>
  input.form-white
  {
    width:95% !important;
  }
</style>
<?php
/*
Template Name: Archives
*/
?>

<?php
get_header();
?>
	<h5>Perspectives</h5>
	<h1>Archives</h1>
	<div class="divider"></div>
<!---
<div id="content2" class="widecolumn">

<?php include (TEMPLATEPATH . '/searchform.php'); ?>



</div>
--->
	<aside class="sm">
      	<div class="right"><a href="http://president.wsu.edu/blog/perspectives/?feed=rss2"><img src="/beta/v1/images/ico-rss.png" alt="RSS feed"></a></div>
        <h4>Recent posts</h4>
    <ul>
      <?php mdv_recent_posts(4,'<li>','</li>',true,0,false);?>
    </ul>
    <?php get_sidebar();?>
      </aside>

<?php while(have_posts()) : the_post(); ?>
<ul>
<?php
$myposts = get_posts('numberposts=2000');
foreach($myposts as $post) :
?>
<li><?php the_time('m/d/y') ?>: <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

<?php endforeach; ?>
</ul>

<?php endwhile; ?>

<?php
upcms_display_sidebar();
get_sidebar();
wp_footer();
upcms_display_footer();