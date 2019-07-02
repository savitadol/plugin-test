<?php
/*
Trigger this file for uninstalling plugin.
*/

defined('WP_UNINSTALL_PLUGIN') or die('You cant access this file directly');

$books=get_posts(['post_type'=>'books','posts_per_page'=>-1]);
foreach ($books as $book) {
	wp_delete_post($book->ID,true);
}