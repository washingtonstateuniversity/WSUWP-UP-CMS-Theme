<?php
/*
Template Name: Archives
*/

get_header();
?>
<style>input.form-white { width:95% !important; }</style>
<h5>Perspectives</h5>
<h1>Archives</h1>
<div class="divider"></div>

<aside class="sm">
	<?php get_sidebar();?>
</aside>

<ul>
<?php

$myposts = get_posts( array( 'posts_per_page' => 2000 ) );
foreach( $myposts as $post ) {
	?><li><?php the_time( 'm/d/y' ) ?>: <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li><?php
}

?>
</ul>

<?php
get_sidebar();
wp_footer();
upcms_display_footer();