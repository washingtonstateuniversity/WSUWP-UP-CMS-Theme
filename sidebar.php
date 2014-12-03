
	<?php  error_reporting(0);
?>
<div id="sidebar">


    <!--FOR FEEDBURNER, put this url in above href http://feeds2.feedburner.com/wsu/EducationBlog/

			<a href="http://president.wsu.edu/blog/perspectives/?page_id=342">Archives</a>-->

			<?php 	/* Widgetized sidebar, if you have the plugin installed. */
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) :
            ?>


				<?php include (TEMPLATEPATH . '/searchform.php'); ?>


			<!-- Author information is disabled per default. Uncomment and fill in your details if you want to use it.
			<h3>Author</h3>
			<p>A little something about you, the author. Nothing lengthy, just an overview.</p>

			-->



			<?php endif; ?>
	</div>


