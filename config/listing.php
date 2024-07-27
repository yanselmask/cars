<?php

/*
|--------------------------------------------------------------------------
| Configuration Settings
|--------------------------------------------------------------------------
|
| This configuration file contains various settings for the application,
| including quantities, UI elements, API keys, and paths.
|
| The settings can be customized by modifying the corresponding environment
| variables in the `.env` file. This allows for flexible configuration
| without changing the codebase directly.
|
| Note that some settings include URLs and API keys which should be updated
| according to your deployment environment and security requirements.
|
*/

return [

    /*
    |--------------------------------------------------------------------------
    | Quantity Settings
    |--------------------------------------------------------------------------
    |
    | These settings define default quantities for various elements within the
    | application. They can be adjusted by setting environment variables in
    | the `.env` file.
    |
    */
    'passengers_qty' => env('PASSENGERS_QTY', 50), // Default number of passengers
    'doors_qty' => env('DOORS_QTY', 10), // Default number of doors
    'cylinders_qty' => env('CYLYNDER_QTY', 16), // Default number of cylinders
    'years_from' => env('YEARS_FROM', 1950), // Start year for filters
    'years_to' => env('YEARS_TO', now()->year + 1), // End year for filters; defaults to the next year

    /*
    |--------------------------------------------------------------------------
    | Date Format and Badge Settings
    |--------------------------------------------------------------------------
    |
    | Defines the date format used in the application and settings related to
    | displaying badges for new posts. The time for marking a post as 'new'
    | is set through an environment variable.
    |
    */
    'date_format' => 'F j, Y', // Date format used in the UI
    'badge_new_post_time' => env('BADGE_NEW_POST_TIME', 7), // Time in days to consider a post as 'new'

    /*
    |--------------------------------------------------------------------------
    | Listing Features and Vendor Page Banner
    |--------------------------------------------------------------------------
    |
    | Configuration for listing feature types and vendor page banners. This
    | includes settings for the banner title, description, image, and app
    | store links. The banner visibility can be toggled.
    |
    */
    'listing_feature_type_showed' => \App\Enums\FeatureType::INTERIOR, // Type of feature displayed in listings
    'vendor_page_banner' => [
        'title' => 'Get our top-rated app!', // Banner title
        'description' => 'Don\'t stop your car search when you leave your computer with our Android and iOS app!', // Banner description
        'image' => null, // Banner image (currently not set)
        'app_store_link' => '#', // Link to the App Store
        'google_play_link' => '#', // Link to Google Play
        'showed' => true // Whether the banner is shown
    ],

    /*
    |--------------------------------------------------------------------------
    | Listing View and Home Page Settings
    |--------------------------------------------------------------------------
    |
    | Settings for the default view of listings and the slug used for the home
    | page. The listing view can be set to 'grid' or 'list'.
    |
    */
    'listing_result_view' => env('LISTING_RESULT_VIEW', 'grid'), // Default view for listing results ('grid' or 'list')
    'slug_home' => 'home', // Slug used for the home page

    /*
    |--------------------------------------------------------------------------
    | Locations Menus and Front Sections
    |--------------------------------------------------------------------------
    |
    | Defines menus for different locations (e.g., header) and types of sections
    | that can be displayed on the front end of the site. This includes various
    | sections for the home page and other content areas.
    |
    */
    'menus_cached' => false,
    'progress_bar' => true,
    'front_sections_type' => [
        'about_us_hero' => 'About Us Hero',
        'list_grid_card' => 'List Grid Card',
        'our_story' => 'Our Story',
        'card_image' => 'Card Image',
        'partners' => 'Partners',
        'faq' => 'Faq',
        'blog' => 'Blog',
        'app_mobile' => 'App Mobile',
        'brands' => 'Brands',
        'map' => 'Map',
        'contact_us' => 'Contact Us',
        'homepage_hero' => 'HomePage Hero'
    ],

    /*
    |--------------------------------------------------------------------------
    | API Keys and Button Visibility
    |--------------------------------------------------------------------------
    |
    | Configuration for API keys, visibility of sign-in and sell car buttons, and
    | footer widgets. API keys should be securely stored and managed.
    |
    */
    'map_api_key' => env('MAP_API_KEY', 'MmtDOmoFbdFVkOnG4QTJ'), // API key for map services
    'show_signin_button' => true, // Whether to show the sign-in button
    'show_sell_car_button' => true, // Whether to show the button to sell a car

    /*
    |--------------------------------------------------------------------------
    | Footer Widgets
    |--------------------------------------------------------------------------
    |
    | Determines which widgets are displayed in the footer. Each widget can be
    | enabled or disabled individually.
    |
    */
    'footer_widgets' => [
        'show_widget_1' => true, // Show first widget
        'show_widget_2' => true, // Show second widget
        'show_widget_3' => true, // Show third widget
        'show_widget_4' => true, // Show fourth widget
        'show_widget_5' => true, // Show fifth widget
    ],

    /*
    |--------------------------------------------------------------------------
    | Contact Subjects and Path Configuration
    |--------------------------------------------------------------------------
    |
    | Lists available subjects for contact forms and defines various paths used
    | within the application for listings, pages, blogs, and administrative areas.
    |
    */
    'subjects_contact' => [
        'Subject 1', // Contact subject 1
        'Subject 2', // Contact subject 2
        'Subject 3', // Contact subject 3
    ],
    'path_listing' => 'listing', // Path for listings
    'path_page' => 'page', // Path for pages
    'path_blog' => 'blog', // Path for the blog
    'path_favorites' => 'favorites', // Path for the favorites
    'path_compares' => 'compares', // Path for the compares
    'path_vendors' => 'vendors', // Path for the vendors
    'admin_path' => 'admin', // Path for the admin panel
    'vendor_path' => 'vendor', // Path for vendor sections,
    'super_admin_email' => 'super@admin.com',

    /*
    |--------------------------------------------------------------------------
    | API and Billing Settings
    |--------------------------------------------------------------------------
    |
    | Configuration for API keys used in development and the billing section
    | of the application. Ensure that sensitive information is kept secure.
    |
    */
    'auto_dev_api' => env('AUTO_DEV_API'), // API key for automatic development
    'billing' => 'plans' // Path for billing and subscription plans

];
