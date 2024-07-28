<?php

namespace Database\Seeders;

use App\Models;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use RyanChandler\FilamentNavigation\Models\Navigation;
use TomatoPHP\FilamentMenus\Models\Menu;
use TomatoPHP\FilamentMenus\Models\MenuItem;

class InstallerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hero = Models\FrontSection::create([
            'name' => 'Hero',
            'key' => 'hero_homepage',
            'data_values' => [
                [
                    'data' => [
                        'image' => '01J3N2JN2TC9531A08HPJFFK08.png',
                        'title' => 'Easy way to find the right car',
                        'description' => 'Finder is a leading digital marketplace for the automotive industry that connects car shoppers with sellers.'
                    ],
                    'type' => 'homepage_hero'
                ]
            ]
        ]);

        $types = Models\FrontSection::create([
            'name' => 'Types',
            'key' => 'types',
            'data_values' => [
                [
                    'data' => [
                        'title' => 'Popular car body types',
                        'types' => ['1', '2', '3', '4', '5']
                    ],
                    'type' => 'types'
                ]
            ]
        ]);

        $offers = Models\FrontSection::create([
            'name' => 'Offers',
            'key' => 'offers',
            'data_values' => [
                [
                    'data' => [
                        'title' => 'Top offers',
                        'listings' => ['93', '94', '95']
                    ],
                    'type' => 'offers'
                ]
            ]
        ]);

        $features = Models\FrontSection::create([
            'name' => 'Features',
            'key' => 'features',
            'data_values' => [
                [
                    'data' => [
                        'list' => [
                            ['icon' => 'fi-file', 'title' => 'Over 1 Million Listings', 'description' => 'That’s more than you’ll find on any other major online automotive marketplace in the USA.'],
                            ['icon' => 'fi-search', 'title' => 'Personalized Search', 'description' => 'Our powerful search makes it easy to personalize your results so you only see the cars and features you care about.'],
                            ['icon' => 'fi-settings', 'title' => 'Non-Stop Innovation', 'description' => 'Our team is constantly developing new features that make the process of buying and selling a car simpler.'],
                            ['icon' => 'fi-info-circle', 'title' => 'Valuable Insights', 'description' => 'We provide free access to key info like dealer reviews, market value, price drops.'],
                            ['icon' => 'fi-users', 'title' => 'Consumer-First Mentality', 'description' => 'We focus on building the most transparent, trustworthy experience for our users, and we’ve proven that works for dealers, too.'],
                            ['icon' => 'fi-calculator', 'title' => 'Online Car Appraisal', 'description' => 'Specify the parameters of your car to form its market value on the basis of similar cars on Finder.']
                        ],
                        'title' => 'What sets Finder apart?',
                        'btn_link' => '#',
                        'btn_text' => 'What sets Finder apart?',
                        'btn_target' => '_self'
                    ],
                    'type' => 'features'
                ]
            ]
        ]);

        $last_listing = Models\FrontSection::create([
            'name' => 'Last Listings',
            'key' => 'last_listing',
            'data_values' => [
                [
                    'data' => [
                        'limit' => '6',
                        'title' => 'Latest cars',
                        'listings' => ['93', '95', '96', '97', '98', '99'],
                        'is_featured' => false,
                        'no_accident' => false,
                        'is_certified' => false,
                        'is_negotiated' => false,
                        'is_single_owner' => false,
                        'is_well_equipped' => false
                    ],
                    'type' => 'listing'
                ]
            ]
        ]);

        $blog = Models\FrontSection::create([
            'name' => 'Blog',
            'key' => 'last_blog',
            'data_values' => [
                [
                    'data' => [
                        'limit' => '10',
                        'posts' => [],
                        'title' => 'Latest news'
                    ],
                    'type' => 'blog'
                ]
            ]
        ]);

        $mobile = Models\FrontSection::create([
            'name' => 'Mobile',
            'key' => 'app_mobile',
            'data_values' => [
                [
                    'data' => [
                        'image' => '01J3NXWYRA4MZHZ12PZ97SBMNN.png',
                        'title' => 'Get the top-rated app!',
                        'description' => 'Download Finder App and join the community of car enthusiasts. Don\'t stop your car search when you leave your computer with our Android and iOS app!',
                        'app_store_link' => '#',
                        'google_play_link' => '#'
                    ],
                    'type' => 'app_mobile'
                ]
            ]
        ]);

        $about_us = Models\FrontSection::create([
            'name' => 'About Us',
            'key' => 'about_us',
            'data_values' => [
                [
                    'data' => [
                        'image' => '01J3P07Q1AYN5YJKB364MVQXFW.jpg',
                        'title' => 'About us',
                        'btn_link' => '#',
                        'btn_text' => '<i class="fi-search me-2"></i> Search car',
                        'btn_color' => 'primary',
                        'btn_target' => '_self',
                        'description' => 'We believe that car buying and selling should be straight-forward and enjoyable, not time-consuming, complicated or stressful.'
                    ],
                    'type' => 'about_us'
                ]
            ]
        ]);

        $list_grid_cards = Models\FrontSection::create([
            'name' => 'List Grid Cards',
            'key' => 'list_grid_cards_about',
            'data_values' => [
                [
                    'data' => [
                        'cards' => [
                            ['image' => '01J3P0FE0ZA1C6WRRSW0HDXH58.svg', 'title' => '~ 1 mln cars', 'description' => 'Fringilla vivamus arcu faucibus malesuada. Dui aenean suspendisse a aliquet id gravida ut. Lorem lacinia sed mauris erat at nisl.'],
                            ['image' => '01J3P0FE12RHTBQ3KY4HH49VRD.svg', 'title' => '5 subsidiaries', 'description' => 'Porttitor bibendum pharetra volutpat est. Vitae tortor magna gravida non lacus. Arcu auctor malesuada dui congue.'],
                            ['image' => '01J3P0FE14C3RJANPD12W6W35V.svg', 'title' => '8 countries', 'description' => 'Duis tortor, vel nisi, leo vulputate sed quis. Ultrices arcu, amet aliquam id massa egestas ut. Dui, sed risus cursus magna dolor.']
                        ],
                        'title' => 'We are new and growing fast'
                    ],
                    'type' => 'list_grid_card'
                ]
            ]
        ]);

        $our_story = Models\FrontSection::create([
            'name' => 'Our story',
            'key' => 'our_story',
            'data_values' => [
                [
                    'data' => [
                        'cards' => [
                            ['title' => '2017', 'description' => 'Odio velit, massa augue etiam in parturient volutpat orci. Pulvinar amet, at est ac curabitur mauris, semper cursus metus. Imperdiet sed massa amet at turpis. Dis risus, donec in ac ultricies tempor eu, amet.'],
                            ['title' => '2018', 'description' => 'Vitae erat ornare facilisi id sollicitudin turpis tempus, semper. Velit integer et volutpat, a. Massa ut amet amet, vitae nunc nulla sed.'],
                            ['title' => '2020', 'description' => 'Ut mattis nascetur aliquam neque velit nunc sed. Morbi congue mauris amet ultrices molestie tellus proin odio diam. Feugiat elit, habitasse egestas egestas id nec potenti. Donec convallis donec tristique mattis et viverra.'],
                            ['title' => '2021', 'description' => 'Tempor nullam pellentesque suspendisse nec. Arcu sagittis sed ut diam in ultrices. Leo lacinia feugiat interdum pellentesque nulla vitae duis.']
                        ],
                        'title' => 'Our story'
                    ],
                    'type' => 'our_story'
                ]
            ]
        ]);

        $personalized_search = Models\FrontSection::create([
            'name' => 'Personalized search',
            'key' => 'personalized_search',
            'data_values' => [
                [
                    'data' => [
                        'image' => '01J3P0XH3GNT0GDVR2GPNR97W8.jpg',
                        'title' => 'Personalized search',
                        'btn_link' => '#',
                        'btn_text' => '<i class="fi-search me-2"></i> Search car',
                        'btn_color' => 'primary',
                        'btn_target' => '_self',
                        'description' => 'Ante senectus sed at lacus. Sed pellentesque dapibus nunc, cursus hendrerit at faucibus ornare lectus. Sed vitae congue mauris consectetur. Cursus tristique et porta eget sapien vivamus turpis. Ultrices vitae eget mattis varius ipsum adipiscing id. Neque, sagittis cursus aliquam volutpat tristique viverra amet amet.',
                        'image_position' => 'left'
                    ],
                    'type' => 'card_image'
                ]
            ]
        ]);

        $attractive = Models\FrontSection::create([
            'name' => 'Attractive selling conditions',
            'key' => 'attractive',
            'data_values' => [
                [
                    'data' => [
                        'image' => '01J3P10RSXYAND0HRN91W32FV9.jpg',
                        'title' => 'Attractive selling conditions',
                        'btn_link' => '#',
                        'btn_text' => '<i class="fi-plus me-2"></i> Sell car',
                        'btn_color' => 'primary',
                        'btn_target' => '_self',
                        'description' => 'In risus quam diam urna, pretium at. Platea nulla malesuada elit, enim lacus quam. Rhoncus, tincidunt mauris quis fames in. A egestas sem quisque urna et imperdiet. Blandit dolor diam urna amet semper elementum ipsum et. Nulla mi ipsum quis et id tempor amet.',
                        'image_position' => 'right'
                    ],
                    'type' => 'card_image'
                ]
            ]
        ]);

        $faqs = Models\FrontSection::create([
            'name' => 'FAQs',
            'key' => 'faqs',
            'data_values' => [
                [
                    'data' => [
                        'faqs' => [
                            ['title' => 'How much does it cost to sell a car on Finder?', 'is_open' => false, 'description' => 'Eum, quaerat. Corporis pariatur cum dolorem ullam at nulla ex doloribus, ratione quos repellendus aliquid aspernatur obcaecati adipisci maxime id, sed cupiditate.'],
                            ['title' => 'How do I take the best pictures of my car?', 'is_open' => false, 'description' => 'Eros aliquam egestas eu sit faucibus facilisi urna, senectus id. Morbi pellentesque at molestie et. Et molestie nunc massa, donec eget viverra. Sodales nisl vitae gravida pretium enim cursus pharetra massa nisl. Auctor porta dolor nulla elementum malesuada ut etiam neque, enim.'],
                            ['title' => 'Can I sell a vehicle if I live outside of the United States?', 'is_open' => false, 'description' => 'Libero ut accusantium ea a ipsa, aliquam nemo aperiam porro deserunt aspernatur sequi amet voluptatibus, fugiat nobis. Atque voluptatibus quibusdam placeat voluptas.'],
                            ['title' => 'How does the buyer get in contact with me and make payment?', 'is_open' => false, 'description' => 'Numquam eaque rerum repellat nisi? Sint, dolorum consequuntur! Provident, voluptate maiores dolorum similique ipsam asperiores quos assumenda hic ad omnis cumque nesciunt.'],
                            ['title' => 'Who writes the listing description for my car?', 'is_open' => false, 'description' => 'Harum temporibus perferendis quam quae, delectus, nulla maiores reiciendis, suscipit obcaecati iure odit illo ea vero. Eveniet minima inventore ratione et voluptatum. Sunt non quod culpa perferendis animi rerum dolorum, perspiciatis aliquam?'],
                            ['title' => 'Are there rules to follow in the comments?', 'is_open' => false, 'description' => 'Fugit facilis tempore consequatur molestiae sapiente. Sit veritatis itaque temporibus illo nisi, in soluta corporis commodi nobis reiciendis laudantium hic facere nostrum provident voluptas perspiciatis, debitis ipsa accusamus aliquid quam iure tempore magni, ratione dignissimos. Minima, a.'],
                            ['title' => 'What currency does Finder use?', 'is_open' => false, 'description' => 'Soluta ea deleniti eaque iusto officiis, at a molestiae ipsum qui pariatur quam, eum consectetur quaerat. Tempora et aut dolorum. Mollitia natus neque veniam consectetur magni asperiores?'],
                            ['title' => 'How do I contact a seller privately?', 'is_open' => false, 'description' => 'Sint labore eaque ad, nostrum quod omnis natus? Consectetur beatae ratione, voluptatem atque iste, fuga ullam nisi soluta dolorem assumenda excepturi! Repellendus, similique atque ratione accusantium fugiat quidem eum quia quam, nulla eaque necessitatibus vitae. Doloremque recusandae aperiam dicta odio modi in fuga iure, itaque quos excepturi.']
                        ],
                        'image' => '01J3P19S01V37SKT1GSWVJH7XQ.png',
                        'title' => 'FAQs',
                        'btn_link' => '#',
                        'btn_text' => 'Help center <i class="fi-chevron-right ms-2"></i>',
                        'btn_color' => 'primary',
                        'btn_target' => '_self',
                        'description' => 'Have you any questions about an buying or selling car? Check out Help Center for all the details.'
                    ],
                    'type' => 'faq'
                ]
            ]
        ]);

        $contact_us = Models\FrontSection::create([
            'name' => 'Contact Us',
            'key' => 'contact_us',
            'data_values' => [
                [
                    'data' => [
                        'list' => [
                            ['icon' => null, 'title' => 'General communication', 'description' => 'For general queries, including partnership opportunities, please email example@email.com'],
                            ['icon' => null, 'title' => 'General communication', 'description' => 'We’re here to help! If you have technical issues contact support'],
                            ['icon' => null, 'title' => 'Our headquarters', 'description' => '8502 Preston Rd. Inglewood, Maine 98380 get directions']
                        ],
                        'title' => 'Contact us',
                        'description' => 'Fill out the form and out team will try to get back to you within 24 hours.'
                    ],
                    'type' => 'contact_us'
                ]
            ]
        ]);

        $map = Models\FrontSection::create([
            'name' => 'Map',
            'key' => 'map',
            'data_values' => [
                [
                    'data' => [
                        'lat' => '40.712784',
                        'long' => '-74.005941',
                        'title' => 'Hi, I\'m in London',
                        'description' => 'Lorem ipsum dolor sit amet elit.'
                    ],
                    'type' => 'map'
                ]
            ]
        ]);

        $homePage = Models\Page::create([
            'name' => 'Home',
        ]);

        $homePage->sections()->attach([
            $hero->id, $types->id, $offers->id, $features->id, $last_listing->id, $mobile->id, $blog->id
        ]);

        $aboutPage = Models\Page::create([
            'name' => 'About Us',
        ]);

        $aboutPage->sections()->attach([
            $about_us->id, $list_grid_cards->id, $our_story->id, $personalized_search->id,  $attractive->id,  $faqs->id, $blog->id
        ]);

        $contactUsPage = Models\Page::create([
            'name' => 'Contact Us',
        ]);

        $contactUsPage->sections()->attach([
            $contact_us->id, $map->id
        ]);

        $headerMenu = Menu::create([
            'title' => 'Header',
            'key' => 'header',
            'location' => 'header',
            'activated' => true
        ]);
        Navigation::create([
            'name' => 'Header',
            'handle' => 'header',
            'items' => '{"05171be7-6ee8-4078-8ae7-1ccecc10b4bf":{"label":"Home","type":"external-link","data":{"url":"\/","target":null},"children":[]},"31ad95d7-9cec-4690-bd94-fddabbdb3b2e":{"label":"Blog","type":"external-link","data":{"url":"\/blog","target":null},"children":[]},"afdf8b18-112a-47bf-9616-100b5615f362":{"label":"Favorites","type":"external-link","data":{"url":"\/favorites","target":null},"children":[]},"232acb30-b9a2-4556-a674-b8b6d5fc98ab":{"label":"Compares","type":"external-link","data":{"url":"\/compares","target":null},"children":[]},"22fd32a2-1b09-4c08-b810-053a3df264cd":{"label":"Contact Us","type":"external-link","data":{"url":"\/page\/contact-us","target":null},"children":[]},"656d0369-0ba7-48b9-a4aa-188a0f08585c":{"label":"About Us","type":"external-link","data":{"url":"\/page\/about-us","target":null},"children":[]}}'
        ]);
        Navigation::create([
            'name' => 'Buying & Selling',
            'handle' => 'footer_menu_1',
            'items' => '{"b108a94a-327e-43bd-9aae-b4578d2aa287":{"label":"Find a car","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"75b471d7-7778-4d0a-94ec-3c160f8086b1":{"label":"Sell your car","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"a2401515-6ac0-48b8-b559-b09277b29049":{"label":"Car dealers","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"73d72bd2-c829-4be5-a71e-25eda7c2c19a":{"label":"Compare cars","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"db2e4f4a-169d-4f31-bc0e-08f70213ab1e":{"label":"Online car appraisal","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]}}'
        ]);
        Navigation::create([
            'name' => 'About',
            'handle' => 'footer_menu_2',
            'items' => '{"5f78eefe-1939-4807-a737-af226faf6115":{"label":"About Finder","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"ff82f7f0-7a7b-4d70-bdc6-7e80a38217f1":{"label":"Contact us","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"983c36c7-c22d-4c74-b99a-c1762aa2c0d2":{"label":"FAQs & support","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":false},"children":[]},"d28e161a-2888-41b1-8c8a-b0ea7741b8b8":{"label":"Mobile app","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"15e414c9-a975-4f23-b686-e1ca574f4d28":{"label":"Blog","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]}}'
        ]);
        Navigation::create([
            'name' => 'Profile',
            'handle' => 'footer_menu_3',
            'items' => '{"dce43be0-3bb0-4931-afb2-3dc7a0fc46bc":{"label":"My account","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"7ddb5e97-7f2b-4122-b9dc-63ec30e2ccce":{"label":"Wishlist","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"f97f8336-130f-4167-8f3d-063919e0f67c":{"label":"My listings","type":"external-link","data":{"icon":null,"icon_position":null,"classes":null,"divider":false,"url":"#","target":""},"children":[]},"8c96aab5-9288-4fdf-b8f5-fd50c2410992":{"label":"Add listing","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]}}'
        ]);
        Navigation::create([
            'name' => 'Footer Bottom Menu',
            'handle' => 'footer_bottom',
            'items' => '{"a4793e74-2f3e-42ef-a629-1c20645eba72":{"label":"Terms of use","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"7f0e00f4-008c-4cb4-8a91-47e187680787":{"label":"Privacy policy","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"47410830-b64c-440d-9e44-42c62e738cc7":{"label":"Accessibility statement","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]},"46c0634f-6c38-4455-92c1-7e2bf940ec67":{"label":"Interest based ads","type":"external-link","data":{"url":"#","target":"","icon":null,"icon_position":null,"classes":null,"divider":null},"children":[]}}'
        ]);
    }
}
