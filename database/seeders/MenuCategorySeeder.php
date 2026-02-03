<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuCategory;

class MenuCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Day Out',
                'slug' => 'day-out',
                'description' => 'Perfect menu options for your day out experience at Soba Lanka Resort.',
                'features' => [
                    'Welcome Drink included',
                    'Breakfast options available',
                    'Lunch buffet selections',
                    'Evening snacks & tea',
                    'Vegetarian options available',
                ],
                'icon' => 'fa-sun',
                'color' => 'amber',
                'sort_order' => 1,
            ],
            [
                'name' => 'Night Stay',
                'slug' => 'night-stay',
                'description' => 'Comprehensive dining options for overnight guests.',
                'features' => [
                    'Dinner & Breakfast included',
                    'Room service available',
                    'Late night snacks',
                    'Morning tea/coffee',
                    'Special dietary accommodations',
                ],
                'icon' => 'fa-moon',
                'color' => 'indigo',
                'sort_order' => 2,
            ],
            [
                'name' => 'Couple Packages',
                'slug' => 'couple-packages',
                'description' => 'Romantic dining experiences designed for couples.',
                'features' => [
                    'Candlelight dinner setup',
                    'Champagne/Wine options',
                    'Private dining available',
                    'Special dessert platter',
                    'Romantic breakfast in bed',
                ],
                'icon' => 'fa-heart',
                'color' => 'pink',
                'sort_order' => 3,
            ],
            [
                'name' => 'Honeymoon',
                'slug' => 'honeymoon',
                'description' => 'Exclusive honeymoon dining packages for newlyweds.',
                'features' => [
                    'Welcome fruit basket',
                    'Honeymoon cake included',
                    'Private poolside dinner',
                    'Complimentary champagne',
                    'Breakfast in cottage',
                ],
                'icon' => 'fa-ring',
                'color' => 'rose',
                'sort_order' => 4,
            ],
            [
                'name' => 'Wedding',
                'slug' => 'wedding',
                'description' => 'Grand wedding reception menus and catering packages.',
                'features' => [
                    'Customizable buffet menus',
                    'Multi-course options',
                    'Wedding cake arrangements',
                    'Bar service available',
                    'Vegetarian & non-veg options',
                    'Live cooking stations',
                ],
                'icon' => 'fa-rings-wedding',
                'color' => 'purple',
                'sort_order' => 5,
            ],
            [
                'name' => 'Engagement',
                'slug' => 'engagement',
                'description' => 'Celebrate your engagement with our special menus.',
                'features' => [
                    'Engagement party buffet',
                    'Cocktail hour options',
                    'Finger food selections',
                    'Celebration cake',
                    'Beverage packages',
                ],
                'icon' => 'fa-gem',
                'color' => 'red',
                'sort_order' => 6,
            ],
            [
                'name' => 'Birthday',
                'slug' => 'birthday',
                'description' => 'Make birthdays special with our celebration menus.',
                'features' => [
                    'Birthday cake arrangements',
                    'Party snack platters',
                    'Kids menu available',
                    'BBQ options',
                    'Customizable packages',
                ],
                'icon' => 'fa-birthday-cake',
                'color' => 'orange',
                'sort_order' => 7,
            ],
            [
                'name' => 'A La Carte',
                'slug' => 'a-la-carte',
                'description' => 'Order individual dishes from our extensive menu.',
                'features' => [
                    'Sri Lankan specialties',
                    'International cuisine',
                    'Seafood selections',
                    'Grilled items',
                    'Fresh salads & soups',
                ],
                'icon' => 'fa-utensils',
                'color' => 'emerald',
                'sort_order' => 8,
            ],
            [
                'name' => 'Dinner & Lunch Only',
                'slug' => 'dinner-lunch',
                'description' => 'Standalone lunch and dinner options for day visitors.',
                'features' => [
                    'Lunch buffet available',
                    'Dinner set menus',
                    'Rice & curry specials',
                    'Western cuisine options',
                    'Dessert included',
                ],
                'icon' => 'fa-bowl-food',
                'color' => 'teal',
                'sort_order' => 9,
            ],
            [
                'name' => 'Bites & Tapas',
                'slug' => 'bites-tapas',
                'description' => 'Light bites, snacks, and tapas-style dishes.',
                'features' => [
                    'Appetizer platters',
                    'Finger food selections',
                    'Poolside snacks',
                    'Evening short eats',
                    'Beverage pairings',
                ],
                'icon' => 'fa-cookie-bite',
                'color' => 'yellow',
                'sort_order' => 10,
            ],
            [
                'name' => 'Beverages',
                'slug' => 'beverages',
                'description' => 'Refreshing drinks, cocktails, and beverage options.',
                'features' => [
                    'Fresh fruit juices',
                    'Mocktails & cocktails',
                    'Tea & coffee selection',
                    'Soft drinks',
                    'Mineral water',
                ],
                'icon' => 'fa-glass-water',
                'color' => 'cyan',
                'sort_order' => 11,
            ],
            [
                'name' => 'Kids Menu',
                'slug' => 'kids-menu',
                'description' => 'Child-friendly meals and treats for young guests.',
                'features' => [
                    'Kid-sized portions',
                    'Healthy options available',
                    'Fun presentation',
                    'Ice cream & desserts',
                    'Special kids drinks',
                ],
                'icon' => 'fa-child',
                'color' => 'sky',
                'sort_order' => 12,
            ],
        ];

        foreach ($categories as $category) {
            MenuCategory::create($category);
        }
    }
}
