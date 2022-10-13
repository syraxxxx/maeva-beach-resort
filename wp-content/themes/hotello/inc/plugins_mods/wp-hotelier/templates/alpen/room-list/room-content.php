<?php

$rooms = new WPBakeryShortCode_Stm_Wp_Hotelier_Rooms_List(array('base' => 'stm_wp_hotelier_rooms_list'));

hotello_add_element_style('wp_hotelier_rooms_list', 'style_1');

echo html_entity_decode($rooms->single_room());