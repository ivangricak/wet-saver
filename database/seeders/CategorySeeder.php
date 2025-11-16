<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories = [
            'Shopping', 'Deals', 'Coupons', 'Wishlist', 'Fashion', 'Electronics', 'Groceries', 'Gifts', 'Daily Needs', 'Accessories',
            'Shoes', 'Home Decor', 'Beauty Products', 'Sports Gear', 'Gadgets', 'Office Supplies', 'Books', 'Kids Items', 'Pet Supplies', 'Travel Essentials',
            'Work', 'Projects', 'Tasks', 'Deadlines', 'Meetings', 'Reports', 'Notes', 'Team', 'Clients', 'Docs',
            'Templates', 'Calendar', 'Goals', 'Plans', 'Strategies', 'Presentations', 'Checklists', 'Finance', 'Contracts', 'Resources',
            'Learning', 'Tutorials', 'Courses', 'Programming', 'Science', 'Math', 'History', 'Languages', 'Reading', 'Articles',
            'Research', 'eBooks', 'Webinars', 'Notes', 'Exams', 'Quizzes', 'Skills', 'Lessons', 'Study Materials', 'Study Plan',
            'Travel', 'Destinations', 'Itineraries', 'Hotels', 'Flights', 'Restaurants', 'Sightseeing', 'Tips', 'Packing', 'Activities',
            'Photography', 'Hiking', 'Sports', 'Art', 'Music', 'Movies', 'Podcasts', 'Games', 'DIY Projects', 'Crafts',
            'Health', 'Fitness', 'Workout', 'Yoga', 'Meditation', 'Nutrition', 'Recipes', 'Drinks', 'Sleep', 'Mindfulness',
            'Entertainment', 'Movies & TV', 'Music', 'Gaming', 'Events', 'Humor', 'Personal', 'Journal', 'Goals', 'Inspiration'
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
