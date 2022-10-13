<?php
$path = 'resources/partials/content/post/single/';
$parts = 'resources/partials/content/post/parts/';


if (hotello_check_string(hotello_get_option('post_title'))) {
	get_template_part("{$path}/title");
}

if (hotello_check_string(hotello_get_option('post_info'))) {
	get_template_part("{$parts}postinfo", 2);
}

if (hotello_check_string(hotello_get_option('post_image'))) {
	get_template_part("{$parts}/image");
}

get_template_part("{$path}/content");

get_template_part("{$path}/actions");

if (hotello_check_string(hotello_get_option('post_author'))) {
	get_template_part("{$path}/author");
}

if (hotello_check_string(hotello_get_option('post_comments'))) {
	get_template_part("{$parts}/comments");
}

