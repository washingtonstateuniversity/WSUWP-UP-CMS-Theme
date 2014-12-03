<?php
/*
Template Name: Links
*/
?>

<?php
get_header();
?>

<div id="content2" class="widecolumn">

<h2>Links:</h2>
<ul>
<?php wp_list_bookmarks(); ?>
</ul>

</div>

<?php
upcms_display_sidebar();
get_sidebar();
upcms_display_footer();