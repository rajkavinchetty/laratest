<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $categories = collect([
            ['name' => 'Technology', 'description' => 'Tech news and tutorials'],
            ['name' => 'DevOps', 'description' => 'CI/CD, deployment, and infrastructure'],
            ['name' => 'Laravel', 'description' => 'Everything about the Laravel framework'],
        ])->map(fn ($cat) => Category::create([
            ...$cat,
            'slug' => Str::slug($cat['name']),
        ]));

        $posts = [
            ['title' => 'Getting Started with Laravel on Serverplane', 'body' => 'This is a guide to deploying your first Laravel application on Serverplane. We cover everything from setting up your repository to configuring your deployment pipeline.', 'category' => 0],
            ['title' => 'CI/CD Best Practices for PHP Applications', 'body' => 'Continuous integration and delivery are essential for modern PHP applications. In this post we discuss testing strategies, automated deployments, and rollback procedures.', 'category' => 1],
            ['title' => 'Understanding Laravel Eloquent Relationships', 'body' => 'Eloquent makes working with database relationships intuitive. We explore hasMany, belongsTo, and many-to-many relationships with practical examples.', 'category' => 2],
            ['title' => 'Docker Containers for Laravel Development', 'body' => 'Using Docker containers ensures your development environment matches production. This tutorial walks through creating a complete Docker setup for Laravel.', 'category' => 1],
            ['title' => 'Building REST APIs with Laravel', 'body' => 'Laravel provides excellent tools for building RESTful APIs. We cover resource controllers, API resources, authentication with Sanctum, and rate limiting.', 'category' => 2],
        ];

        foreach ($posts as $postData) {
            $post = Post::create([
                'user_id' => $user->id,
                'category_id' => $categories[$postData['category']]->id,
                'title' => $postData['title'],
                'slug' => Str::slug($postData['title']),
                'body' => $postData['body'],
                'status' => 'published',
                'published_at' => now()->subDays(rand(1, 30)),
            ]);

            Comment::create([
                'post_id' => $post->id,
                'author_name' => 'Jane Doe',
                'author_email' => 'jane@example.com',
                'body' => 'Great article! Very helpful for getting started.',
                'is_approved' => true,
            ]);
        }
    }
}
