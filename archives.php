<?php
/*
Template Name: Archives
*/
$cms_template_args = array( 'url' => get_the_permalink() );
upcms_display_template_before( $cms_template_args );
?>

<aside>
	<?php get_sidebar();?>
</aside>
<h3>List of Perspectives</h3>



<?php

$myposts = get_posts( array( 'posts_per_page' => 2000 ) );
foreach( $myposts as $post ) {
	?><p><?php the_time( 'm/d/y' ) ?>: <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p><?php
}

?>


<?php
get_sidebar();
wp_footer();
upcms_display_template_after();