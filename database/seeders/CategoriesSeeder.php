<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Кошки',
                'slug' => 'cats',
                'description' => 'Корма, игрушки и аксессуары для кошек.',
            ],
            [
                'name' => 'Собаки',
                'slug' => 'dogs',
                'description' => 'Товары для ухода, кормления и прогулок с собаками.',
            ],
            [
                'name' => 'Птицы',
                'slug' => 'birds',
                'description' => 'Корма, клетки и аксессуары для домашних птиц.',
            ],
            [
                'name' => 'Грызуны',
                'slug' => 'rodents',
                'description' => 'Все необходимое для хомяков, морских свинок и других грызунов.',
            ],
            [
                'name' => 'Аквариум',
                'slug' => 'aquarium',
                'description' => 'Товары для рыб, аквариумов и ухода за водой.',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                ]
            );
        }
    }
}
