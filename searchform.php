<form method="get" id="searchform" action="<?php echo esc_url( home_url() ); ?>">
<label class="hidden" for="s"><?php _e('Search for:'); ?></label>
<div><input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
<div style="padding-bottom:3px;"></div><input type="submit" id="searchsubmit" value="Search" />
</div>
</form>
