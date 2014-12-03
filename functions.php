<?php
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '<p id="%1$s" class="widget %2$s">',
        'after_widget' => '</p>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
