<?php
get_header();
?>
<style>
    #dateicon {
		-moz-background-clip:border;
		-moz-background-inline-policy:continuous;
		-moz-background-origin:padding;
		color: #FFFFFF;
		float:left;
		height:42px;
		margin-top:2px;
		width:42px;
    }

    #dateicon h4 {
		color:#67767D;
		font-family:"Lucida Sans";
		font-size:16px;
		font-weight:bold;
		line-height:1.5em;
		padding-left:0;
		text-align:center;
    }

    #dateicon h5 {
		color:#FFFFFF;
		font-size:0.6em;
		font-weight:normal;
		line-height:1em;
		margin-top:1px;
		padding-left:0;
		text-align:center;
		text-transform:uppercase;
	}
    input.form-white { width:95% !important; }
	h3{ line-height:normal; }
	.wpdate { margin-top:20px; }
</style>
	<h1>Perspectives</h1>
	<div class="divider"></div>
	<aside class="sm">
		<?php get_sidebar();?>
	</aside>

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

				<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<p class="wpdate"><em><?php the_date(); ?></em></p>

				<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
				</div>
				<div class="meta"></div>

		<?php endwhile; ?>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>

	<?php endif; ?>

<?php
upcms_display_footer();