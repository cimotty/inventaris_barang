<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\News;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Item::factory(200)->create();
        // News::factory(60)->create();
        User::factory(1)->create();
    }
}
