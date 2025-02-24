<?php

namespace Database\Seeders;

use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users with motorsports-themed usernames
        $motorsportDrivers = [
            'MaxVerstappen',
            'LewisHamilton',
            'CharlesLeclerc',
            'ValtteriBottas',
            'LandoNorris',
            'SergioPerez',
            'CarlosSainz',
            'DanielRicciardo',
            'FernandoAlonso',
            'SebastianVettel',
        ];

        \App\Models\User::create([
            'name' => 'Zafer Bilen',
            'email' => 'zafer@bilen.dev',
            'password' => '123',
            'bio' => 'Hamilton fanıyım, Ferrari seviyom ve F1 seyircisiyim.',
            'status' => 'active',
        ]);

        \App\Models\User::create([
            'name' => 'Test Kullanıcı',
            'email' => 'test@test.test',
            'password' => '123',
            'bio' => 'Hamilton fanıyım, Ferrari seviyom ve F1 seyircisiyim.',
            'status' => 'active',
        ]);

        foreach ($motorsportDrivers as $username) {
            \App\Models\User::create([
                'name' => $username,
                'email' => strtolower($username).'@example.com',
                'password' => bcrypt('password'),
                'bio' => fake()->sentence(20),
                'status' => 'active',
            ]);
        }

        $categories = [
            'Formula 1',
            'MotoGP',
            'NASCAR',
            'Rally',
            'Endurance Racing',
            'Karting',
            'DTM',
            'Formula E',
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create([
                'name' => $category,
                'detail' => "Everything about $category racing and competitions",
                'slug' => strtolower(str_replace(' ', '-', $category)),
            ]);
        }

        $topics = [
            'Race Results' => 'Latest race results and standings',
            'Driver Transfers' => 'News and rumors about driver transfers',
            'Technical Analysis' => 'Deep dive into racing technology and regulations',
            'Race Strategy' => 'Discussion about race strategies and tactics',
            'Track Analysis' => 'Information about racing circuits and tracks',
            'Team Updates' => 'Latest news about racing teams',
            'Safety Discussions' => 'Topics about racing safety and regulations',
            'Historical Events' => 'Notable moments in motorsport history',
        ];

        foreach ($topics as $name => $description) {
            \App\Models\Topic::create([
                'name' => $name,
                'detail' => $description,
                'slug' => strtolower(str_replace(' ', '-', $name)),
                'category_id' => rand(1, count($categories)),
            ]);
        }

        // Create forms
        for ($i = 0; $i < 30; $i++) {
            \App\Models\Post::create([
                'user_id' => rand(1, 10),
                'category_id' => rand(1, count($categories)),
                'topic_id' => rand(1, count($topics)),
                'title' => fake()->sentence(rand(4, 8)),
                'content' => fake()->paragraphs(rand(3, 6), true),
                'status' => 'active',
            ]);

        }

        // Create fake comments for posts
        for ($i = 0; $i < 100; $i++) {
            Comment::create([
                'user_id' => rand(1, 10),
                'post_id' => rand(1, 30),
                'comment' => fake()->sentence(rand(10, 20)),
            ]);
        }

        // Create favorite categories
        for ($i = 0; $i < 30; $i++) {
            \App\Models\FavoriteCategory::create([
                'user_id' => rand(1, 10),
                'category_id' => rand(1, count($categories)),
            ]);
        }

        // Create favorite topics
        for ($i = 0; $i < 30; $i++) {
            \App\Models\FavoriteTopic::create([
                'user_id' => rand(1, 10),
                'topic_id' => rand(1, count($topics)),
            ]);
        }
    }
}
