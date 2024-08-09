<?php


return [

    /*
    |--------------------------------------------------------------------------
    | Spark Path
    |--------------------------------------------------------------------------
    |
    | This configuration option determines the URI at which the Spark billing
    | portal is available. You are free to change this URI to a value that
    | you prefer. You shall link to this location from your application.
    |
    */

    'path' => 'billing',

    /*
    |--------------------------------------------------------------------------
    | Spark Middleware
    |--------------------------------------------------------------------------
    |
    | These are the middleware that requests to the Spark billing portal must
    | pass through before being accepted. Typically, the default list that
    | is defined below should be suitable for most Laravel applications.
    |
    */

    'middleware' => ['web', 'auth','role:Super Admin|' . config('listing.seller_role')],

    /*
    |--------------------------------------------------------------------------
    | Branding
    |--------------------------------------------------------------------------
    |
    | These configuration values allow you to customize the branding of the
    | billing portal, including the primary color and the logo that will
    | be displayed within the billing portal. This logo value must be
    | the absolute path to an SVG logo within the local filesystem.
    |
    */

    'brand' =>  [
        'logo' => realpath(__DIR__ . '../public/asset/site_logo.png'),
        'color' => 'bg-gray-800',
    ],

    /*
    |--------------------------------------------------------------------------
    | Proration Behavior
    |--------------------------------------------------------------------------
    |
    | This value determines if charges are prorated when making adjustments
    | to a plan such as incrementing or decrementing the quantity of the
    | plan. This also determines proration behavior if changing plans.
    |
    */

    'prorates' => true,

    /*
    |--------------------------------------------------------------------------
    | Spark Date Format
    |--------------------------------------------------------------------------
    |
    | This date format will be utilized by Spark to format dates in various
    | locations within the billing portal, such as while showing invoice
    | dates. You should customize the format based on your own locale.
    |
    */

    'date_format' => 'F j, Y',

    'dashboard_url' => config('listing.vendor_path'),

    /*
    |--------------------------------------------------------------------------
    | Spark Billables
    |--------------------------------------------------------------------------
    |
    | Below you may define billable entities supported by your Spark driven
    | application. The Paddle edition of Spark currently only supports a
    | single billable model entity (team, user, etc.) per application.
    |
    | In addition to defining your billable entity, you may also define its
    | plans and the plan's features, including a short description of it
    | as well as a "bullet point" listing of its distinctive features.
    |
    */

    'billables' => [

        'user' => [
            'model' => \App\Models\User::class,

            'trial_days' => 0,

            'default_interval' => 'monthly',

            'plans' => [
                [
                    'icon' => 'theme/img/icon-1.svg',
                    'name' => 'Basic',
                    'price_formatted' => '$9.99',
                    'short_description' => 'This is a short, human friendly description of the plan.',
                    'monthly_id' => 'pri_01j38742kbrzd2ccyydaeghh0s',
                    'yearly_id' => 'pri_01j3874eqz5nz619twfghe14xp',
                    'features' => [
                        'Up to 5 listings allowed',
                        'Up to 5 photos per listing',
                        '3 Featured Listing',
                        '--You can change slug of listings',
                        '--You can linked video for listings',
                    ],
                    'options' => [
                        'listing' => 5,
                        'listing_featured' => 3,
                        'images_limit' => 5,
                        'can_change_slug' => false,
                        'can_linked_video' => false
                    ],
                    'archived' => false,
                ],
                [
                    'icon' => 'theme/img/icon-2.svg',
                    'featured' => true,
                    'name' => 'Standard',
                    'price_formatted' => '$24.99',
                    'short_description' => 'This is a short, human friendly description of the plan.',
                    'monthly_id' => 'pri_01j3jjpdgvjxk5xj39y9025qk7',
                    'yearly_id' => 'pri_01j3jjqb9n92cm0tbrts5t8462',
                    'yearly_incentive' => 'Save 10%',
                    'features' => [
                        'Up to 25 listings allowed',
                        'Up to 10 photos per listing',
                        '10 Featured Listing',
                        'You can change slug of listings',
                        'You can linked video for listings',
                    ],
                    'options' => [
                        'listing' => 25,
                        'listing_featured' => 10,
                        'images_limit' => 10,
                        'can_change_slug' => true,
                        'can_linked_video' => true
                    ],
                    'archived' => false,
                ],
                [
                    'icon' => 'theme/img/icon-3.svg',
                    'name' => 'Premium',
                    'price_formatted' => '$49.99',
                    'short_description' => 'This is a short, human friendly description of the plan.',
                    'monthly_id' =>  'pri_01j3kgrt2yj3zemwxx316bxq1m',
                    'yearly_id' => 'pri_01j3kgs5keym2vjffnz5pjm7kx',
                    'yearly_incentive' => 'Save 35%',
                    'features' => [
                        'Up to 100 listings allowed',
                        'Up to 35 photos per listing',
                        '35 Featured Listing',
                        'You can change slug of listings',
                        'You can linked video for listings',
                    ],
                    'options' => [
                        'listing' => 100,
                        'listing_featured' => 35,
                        'images_limit' => 15,
                        'can_change_slug' => true,
                        'can_linked_video' => true
                    ],
                    'archived' => false,
                ],

            ],

        ],

    ],
];
