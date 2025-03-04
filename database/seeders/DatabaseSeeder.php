<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)
            ->has(Post::factory(3)
                ->has(Comment::factory(4)->for(User::factory()))
                ->has(Like::factory(10)->for(User::factory()))
//                ->has(Comment::factory(4)->for(User::all()->random()))
//                ->has(Like::factory(10)->for(User::all()->random()))
            )->create();

        $users = User::all();

        foreach ($users as $user) {
            $randomUsers = User::query()
                ->inRandomOrder(rand(1, 30))
                ->get();

            $subscriptions = [];

            foreach ($randomUsers as $randomUser) {
                $subscriptions[] = [
                    'user_id' => $user->id,
                    'subscription_id' => $randomUser->id,
                ];
            }

            Subscription::query()->insert($subscriptions);

        }
    }
}
