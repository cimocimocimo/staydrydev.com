<?php

namespace Tonik\Theme\App\Structure;

/*
|-----------------------------------------------------------
| Theme Custom Post Types
|-----------------------------------------------------------
|
| This file is for registering your theme post types.
| Custom post types allow users to easily create
| and manage various types of content.
|
*/

use function Tonik\Theme\App\config;

/**
 * Registers `corporate_customer` custom post type.
 *
 * @return void
 */
function register_corporate_customer_post_type()
{
    register_post_type('corporate_customer', [
        'description' => __('Corporate customers who have purchased StayDry products.', config('textdomain')),
        'public' => false,
        'show_in_menu' => true,
        'show_ui' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-building',
        'supports' => ['title', 'thumbnail'],
        'labels' => [
            'name' => _x('Corp. Customers', 'post type general name', config('textdomain')),
            'singular_name' => _x('Corp. Customer', 'post type singular name', config('textdomain')),
            'menu_name' => _x('Corp. Customers', 'admin menu', config('textdomain')),
            'name_admin_bar' => _x('Corp. Customer', 'add new on admin bar', config('textdomain')),
            'add_new' => _x('Add New', 'corp. customer', config('textdomain')),
            'add_new_item' => __('Add New Corp. Customer', config('textdomain')),
            'new_item' => __('New Corp. Customer', config('textdomain')),
            'edit_item' => __('Edit Corp. Customer', config('textdomain')),
            'view_item' => __('View Corp. Customer', config('textdomain')),
            'all_items' => __('All Corp. Customers', config('textdomain')),
            'search_items' => __('Search Corp. Customers', config('textdomain')),
            'parent_item_colon' => __('Parent Corp. Customers:', config('textdomain')),
            'not_found' => __('No corporate customers found.', config('textdomain')),
            'not_found_in_trash' => __('No corporate customers found in Trash.', config('textdomain')),
        ],
    ]);
}
add_action('init', 'Tonik\Theme\App\Structure\register_corporate_customer_post_type');
