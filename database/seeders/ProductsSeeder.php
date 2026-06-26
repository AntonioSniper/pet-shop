<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        $categorySlugs = [
            'cats',
            'dogs',
            'birds',
            'rodents',
            'aquarium',
        ];

        if (Category::whereIn('slug', $categorySlugs)->count() < count($categorySlugs)) {
            $this->call(CategoriesSeeder::class);
        }

        $categories = Category::whereIn('slug', $categorySlugs)->get()->keyBy('slug');

        $products = [
            [
                'category' => 'cats',
                'name' => 'Сухой корм для кошек с курицей',
                'slug' => 'cat-dry-food-chicken',
                'description' => 'Полнорационный корм для взрослых кошек с нежным вкусом курицы.',
            ],
            [
                'category' => 'cats',
                'name' => 'Наполнитель для кошачьего туалета',
                'slug' => 'cat-litter-clumping',
                'description' => 'Комкующийся наполнитель с хорошим удержанием запаха.',
            ],
            [
                'category' => 'cats',
                'name' => 'Игрушка-мышка для кошек',
                'slug' => 'cat-toy-mouse',
                'description' => 'Мягкая игрушка для активных игр и тренировки охотничьих привычек.',
            ],
            [
                'category' => 'cats',
                'name' => 'Когтеточка с джутовой обмоткой',
                'slug' => 'cat-scratcher-jute',
                'description' => 'Устойчивая когтеточка помогает сохранить мебель и занять питомца.',
            ],
            [
                'category' => 'dogs',
                'name' => 'Сухой корм для собак с говядиной',
                'slug' => 'dog-dry-food-beef',
                'description' => 'Питательный корм для ежедневного рациона взрослых собак.',
            ],
            [
                'category' => 'dogs',
                'name' => 'Резиновая игрушка для собак',
                'slug' => 'dog-rubber-toy',
                'description' => 'Прочная игрушка для жевания, апортировки и веселых прогулок.',
            ],
            [
                'category' => 'dogs',
                'name' => 'Поводок с мягкой ручкой',
                'slug' => 'dog-soft-leash',
                'description' => 'Надежный поводок для ежедневных прогулок с комфортной ручкой.',
            ],
            [
                'category' => 'dogs',
                'name' => 'Шампунь для собак с ромашкой',
                'slug' => 'dog-chamomile-shampoo',
                'description' => 'Мягкий шампунь очищает шерсть и подходит для регулярного ухода.',
            ],
            [
                'category' => 'birds',
                'name' => 'Зерновая смесь для попугаев',
                'slug' => 'bird-seed-parrots',
                'description' => 'Сбалансированная смесь зерен и семян для волнистых попугаев.',
            ],
            [
                'category' => 'birds',
                'name' => 'Клетка для декоративных птиц',
                'slug' => 'bird-cage-decorative',
                'description' => 'Просторная клетка с жердочками и удобным выдвижным поддоном.',
            ],
            [
                'category' => 'birds',
                'name' => 'Минеральный камень для птиц',
                'slug' => 'bird-mineral-stone',
                'description' => 'Источник минералов для здоровья клюва и общего тонуса птицы.',
            ],
            [
                'category' => 'birds',
                'name' => 'Качели для попугаев',
                'slug' => 'bird-swing-parrots',
                'description' => 'Подвесные качели для игр и отдыха домашних птиц.',
            ],
            [
                'category' => 'rodents',
                'name' => 'Корм для хомяков с овощами',
                'slug' => 'hamster-food-vegetables',
                'description' => 'Питательная смесь с зернами, овощами и полезными добавками.',
            ],
            [
                'category' => 'rodents',
                'name' => 'Домик для грызунов',
                'slug' => 'rodent-house-wood',
                'description' => 'Уютный деревянный домик для отдыха и укрытия маленького питомца.',
            ],
            [
                'category' => 'rodents',
                'name' => 'Колесо для хомяка',
                'slug' => 'hamster-running-wheel',
                'description' => 'Бесшумное колесо помогает питомцу поддерживать активность.',
            ],
            [
                'category' => 'rodents',
                'name' => 'Сено луговое для грызунов',
                'slug' => 'rodent-meadow-hay',
                'description' => 'Ароматное сено для питания и обустройства клетки.',
            ],
            [
                'category' => 'aquarium',
                'name' => 'Корм для аквариумных рыб',
                'slug' => 'fish-food-flakes',
                'description' => 'Хлопьевидный корм для ежедневного питания аквариумных рыб.',
            ],
            [
                'category' => 'aquarium',
                'name' => 'Фильтр для аквариума',
                'slug' => 'aquarium-filter-internal',
                'description' => 'Внутренний фильтр поддерживает чистоту воды и комфорт рыб.',
            ],
            [
                'category' => 'aquarium',
                'name' => 'Декоративный грунт для аквариума',
                'slug' => 'aquarium-decorative-gravel',
                'description' => 'Цветной грунт для оформления дна и создания красивого аквариума.',
            ],
            [
                'category' => 'aquarium',
                'name' => 'Средство для подготовки воды',
                'slug' => 'aquarium-water-conditioner',
                'description' => 'Кондиционер помогает подготовить водопроводную воду для рыб.',
            ],
        ];

        foreach ($products as $product) {
            $category = $categories->get($product['category']);

            if ($category === null) {
                continue;
            }

            $productModel = Product::firstOrCreate(
                ['slug' => $product['slug']],
                [
                    'category_id' => $category->id,
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'price' => $this->randomPrice(),
                    'stock' => random_int(5, 60),
                    'image' => null,
                    'is_active' => true,
                ]
            );

            if ($productModel->image !== null) {
                $productModel->update(['image' => null]);
            }
        }
    }

    private function randomPrice(): string
    {
        return number_format(random_int(19900, 499900) / 100, 2, '.', '');
    }
}
